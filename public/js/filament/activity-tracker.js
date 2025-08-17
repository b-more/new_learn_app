// public/js/activity-tracker.js

class ActivityTracker {
    constructor() {
        this.userId = null;
        this.currentModuleId = null;
        this.currentLessonId = null;
        this.sessionStartTime = Date.now();
        this.lastProgressReport = Date.now();
        this.csrfToken = null;

        this.init();
    }

    init() {
        // Get CSRF token
        const token = document.querySelector('meta[name="csrf-token"]');
        if (token) {
            this.csrfToken = token.getAttribute('content');
        }

        // Track page visibility changes
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                this.pauseTracking();
            } else {
                this.resumeTracking();
            }
        });

        // Track when user leaves the page
        window.addEventListener('beforeunload', () => {
            this.trackPageExit();
        });
    }

    setContext(userId, moduleId = null, lessonId = null) {
        this.userId = userId;
        this.currentModuleId = moduleId;
        this.currentLessonId = lessonId;
    }

    async trackModuleAccess(moduleId) {
        this.currentModuleId = moduleId;

        return await this.sendActivity({
            action: 'module_access',
            module_id: moduleId
        });
    }

    async trackLessonAccess(lessonId, moduleId) {
        this.currentLessonId = lessonId;
        this.currentModuleId = moduleId;

        return await this.sendActivity({
            action: 'lesson_access',
            lesson_id: lessonId,
            module_id: moduleId
        });
    }

    async trackVideoEvent(eventType, data = {}) {
        if (!this.currentLessonId) return;

        const videoData = {
            action: 'video_event',
            event_type: eventType,
            lesson_id: this.currentLessonId,
            module_id: this.currentModuleId,
            timestamp: Date.now(),
            ...data
        };

        return await this.sendActivity(videoData);
    }

    initVideoTracking(videoElement) {
        if (!videoElement) return;

        const video = videoElement.tagName === 'VIDEO' ? videoElement : videoElement.querySelector('video');
        if (!video) return;

        let progressReportInterval;
        let lastReportedProgress = 0;

        // Track video play
        video.addEventListener('play', () => {
            this.trackVideoEvent('play', {
                current_time: video.currentTime,
                duration: video.duration
            });

            // Start progress tracking
            progressReportInterval = setInterval(() => {
                if (!video.paused && !video.ended && video.duration > 0) {
                    const progress = Math.round((video.currentTime / video.duration) * 100);

                    // Report progress every 5% increment or every 30 seconds
                    if (progress - lastReportedProgress >= 5 ||
                        Date.now() - this.lastProgressReport > 30000) {

                        this.trackVideoEvent('progress', {
                            current_time: video.currentTime,
                            duration: video.duration,
                            progress_percentage: progress,
                            watch_time_seconds: video.currentTime
                        });

                        lastReportedProgress = progress;
                        this.lastProgressReport = Date.now();
                    }
                }
            }, 5000);
        });

        // Track video pause
        video.addEventListener('pause', () => {
            if (progressReportInterval) {
                clearInterval(progressReportInterval);
            }

            if (video.duration > 0) {
                this.trackVideoEvent('pause', {
                    current_time: video.currentTime,
                    duration: video.duration,
                    progress_percentage: Math.round((video.currentTime / video.duration) * 100)
                });
            }
        });

        // Track video completion
        video.addEventListener('ended', () => {
            if (progressReportInterval) {
                clearInterval(progressReportInterval);
            }

            this.trackVideoEvent('completed', {
                current_time: video.currentTime,
                duration: video.duration,
                progress_percentage: 100,
                watch_time_seconds: video.duration
            });
        });

        // Track seeking
        video.addEventListener('seeked', () => {
            if (video.duration > 0) {
                this.trackVideoEvent('seek', {
                    current_time: video.currentTime,
                    duration: video.duration,
                    progress_percentage: Math.round((video.currentTime / video.duration) * 100)
                });
            }
        });
    }

    async trackDocumentDownload(documentPath, documentName, lessonId) {
        return await this.sendActivity({
            action: 'document_download',
            document_path: documentPath,
            document_name: documentName,
            lesson_id: lessonId || this.currentLessonId,
            module_id: this.currentModuleId
        });
    }

    initDocumentTracking() {
        document.addEventListener('click', (event) => {
            const link = event.target.closest('a[download]');
            if (link && link.href) {
                const url = new URL(link.href);
                const pathParts = url.pathname.split('/');
                const fileName = pathParts[pathParts.length - 1];

                // Extract document path from storage URL
                const documentPath = url.pathname.replace('/storage/', '');

                this.trackDocumentDownload(documentPath, fileName, this.currentLessonId);
            }
        });
    }

    async trackQuizStart(lessonId, moduleId) {
        return await this.sendActivity({
            action: 'quiz_start',
            lesson_id: lessonId,
            module_id: moduleId
        });
    }

    async trackQuizSubmission(answers, lessonId, moduleId) {
        return await this.sendActivity({
            action: 'quiz_submission',
            lesson_id: lessonId,
            module_id: moduleId,
            answers: answers,
            submission_time: Date.now()
        });
    }

    async sendActivity(activityData) {
        if (!this.userId) {
            console.warn('ActivityTracker: No user ID set');
            return;
        }

        try {
            const response = await fetch('/api/activity/track', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': this.csrfToken
                },
                body: JSON.stringify({
                    user_id: this.userId,
                    ...activityData
                })
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            return await response.json();
        } catch (error) {
            console.error('ActivityTracker: Failed to send activity', error);
        }
    }

    pauseTracking() {
        // Implementation for pausing tracking
    }

    resumeTracking() {
        // Implementation for resuming tracking
    }

    trackPageExit() {
        if (this.currentLessonId && navigator.sendBeacon) {
            const data = JSON.stringify({
                user_id: this.userId,
                action: 'page_exit',
                lesson_id: this.currentLessonId,
                module_id: this.currentModuleId,
                session_duration: Date.now() - this.sessionStartTime
            });

            navigator.sendBeacon('/api/activity/track', data);
        }
    }
}

// Initialize global activity tracker
window.activityTracker = new ActivityTracker();

// Integration with existing lesson system
document.addEventListener('DOMContentLoaded', function() {
    // Set up document download tracking
    window.activityTracker.initDocumentTracking();

    // Enhanced lesson button click tracking
    document.querySelectorAll('.lesson-button').forEach(lessonButton => {
        lessonButton.addEventListener('click', function() {
            const lessonId = this.getAttribute('data-id');
            const moduleId = this.getAttribute('data-module-id');

            window.activityTracker.setContext(
                window.currentUserId,
                moduleId,
                lessonId
            );

            window.activityTracker.trackLessonAccess(lessonId, moduleId);

            // Track video initialization when video is loaded
            setTimeout(() => {
                const videoContainer = document.getElementById('video_show');
                if (videoContainer) {
                    const video = videoContainer.querySelector('video');
                    if (video) {
                        window.activityTracker.initVideoTracking(videoContainer);
                    }
                }
            }, 1000);
        });
    });

    // Enhanced quiz form tracking
    const quizForm = document.getElementById('quiz_form');
    if (quizForm) {
        // Track quiz submission
        quizForm.addEventListener('submit', function(event) {
            const formData = new FormData(this);
            const answers = {};

            for (let [key, value] of formData.entries()) {
                if (key.startsWith('options_')) {
                    answers[key] = value;
                }
            }

            window.activityTracker.trackQuizSubmission(
                answers,
                window.activityTracker.currentLessonId,
                window.activityTracker.currentModuleId
            );
        });
    }
});

// Helper function to set user context globally
window.setUserContext = function(userId, moduleId = null, lessonId = null) {
    window.currentUserId = userId;
    window.activityTracker.setContext(userId, moduleId, lessonId);
};
