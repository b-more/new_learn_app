<x-filament-panels::page>
<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
/* Enhanced Quiz Styles */
.quiz-timer-container {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 12px;
    padding: 16px;
    margin-bottom: 24px;
    color: white;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.timer-display {
    font-size: 28px;
    font-weight: bold;
    text-align: center;
    font-family: 'Courier New', monospace;
}

.timer-progress-bar {
    background: rgba(255, 255, 255, 0.3);
    border-radius: 10px;
    height: 8px;
    margin-top: 12px;
    overflow: hidden;
}

.timer-progress-fill {
    height: 100%;
    border-radius: 10px;
    transition: all 1s ease;
    background: linear-gradient(90deg, #4CAF50, #8BC34A);
}

.timer-warning {
    background: #FFF3CD;
    color: #856404;
    border: 1px solid #FFEAA7;
    border-radius: 8px;
    padding: 12px;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    animation: pulse 2s infinite;
}

.timer-expired {
    background: #F8D7DA;
    color: #721C24;
    border: 1px solid #F5C6CB;
    border-radius: 8px;
    padding: 12px;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    animation: pulse 1s infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.8; }
}

.hidden {
    display: none !important;
}

.step {
    display: none;
}

.step.active {
    display: block;
}

/* Quiz Container */
.quiz-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

.lesson-card {
    background: white;
    border-radius: 12px;
    padding: 24px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

/* Enhanced Quiz Question Styling */
.quiz-question {
    background: rgba(34, 197, 94, 0.1);
    padding: 24px;
    border-radius: 12px;
    margin-bottom: 24px;
    font-weight: 600;
    border-left: 4px solid #22c55e;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.question-header {
    display: flex;
    align-items: flex-start;
    gap: 12px;
}

.question-number {
    font-weight: bold;
    color: #22c55e;
    font-size: 18px;
    flex-shrink: 0;
    line-height: 1.5;
}

.question-text {
    flex: 1;
    line-height: 1.6;
    font-size: 16px;
}

/* Enhanced Quiz Options */
.quiz-options-container {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-top: 20px;
}

.quiz-option {
    display: flex;
    align-items: flex-start;
    padding: 16px;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    background: white;
    transition: all 0.3s ease;
    cursor: pointer;
    min-height: 60px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
}

.quiz-option:hover {
    border-color: #3b82f6;
    background-color: #f8fafc;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    transform: translateY(-1px);
}

.quiz-option.selected {
    border-color: #22c55e;
    background-color: #f0fdf4;
    box-shadow: 0 2px 8px rgba(34, 197, 94, 0.15);
}

.quiz-option input[type="radio"] {
    width: 20px;
    height: 20px;
    margin: 0;
    margin-right: 16px;
    margin-top: 2px;
    flex-shrink: 0;
    accent-color: #22c55e;
}

.option-content {
    flex: 1;
    display: flex;
    align-items: flex-start;
    gap: 8px;
}

.option-letter {
    font-weight: bold;
    color: #22c55e;
    font-size: 16px;
    flex-shrink: 0;
    line-height: 1.5;
}

.option-text {
    font-size: 15px;
    line-height: 1.5;
    color: #374151;
    flex: 1;
    word-wrap: break-word;
    font-weight: 500;
}

/* Button Styles */
.btn {
    padding: 12px 24px;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.btn-primary {
    background: #22c55e;
    color: white;
}

.btn-primary:hover {
    background: #16a34a;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(34, 197, 94, 0.3);
}

.btn-secondary {
    background: #6b7280;
    color: white;
}

.btn-secondary:hover {
    background: #4b5563;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(107, 114, 128, 0.3);
}

/* Responsive Design */
@media (max-width: 768px) {
    .quiz-container {
        padding: 16px;
    }

    .quiz-option {
        padding: 12px;
        min-height: 50px;
    }

    .quiz-option input[type="radio"] {
        width: 18px;
        height: 18px;
        margin-right: 12px;
    }

    .option-text {
        font-size: 14px;
    }

    .question-number {
        font-size: 16px;
    }

    .question-text {
        font-size: 15px;
    }
}

/* Focus states for accessibility */
.quiz-option:focus-within {
    outline: 2px solid #22c55e;
    outline-offset: 2px;
}

.quiz-option input[type="radio"]:focus {
    outline: none;
}
</style>

<div class="quiz-container">
    <!-- Header -->
    <div class="lesson-card">
        <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $module_title }}</h1>
        <p class="text-gray-600">Complete the lesson and take the quiz to proceed</p>
    </div>

    <!-- Step 1: Lesson Content -->
    <div class="step active" id="step1">
        @if($lessons->count() > 0)
            @php $lesson = $lessons->first() @endphp

            <div class="lesson-card">
                <h2 class="text-xl font-semibold mb-4">{{ $lesson->title }}</h2>

                @if($lesson->description)
                    <div class="mb-6 text-gray-700">
                        {{ $lesson->description }}
                    </div>
                @endif

                <!-- Video Section -->
                @if($lesson->video_url)
                    <div class="mb-6">
                        <h3 class="text-lg font-medium mb-3">Video Lesson</h3>
                        <div class="bg-black rounded-lg overflow-hidden">
                            <video controls style="width: 100%; height: auto;">
                                <source src="{{ asset('storage/' . $lesson->video_url) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                        @if($lesson->video_length)
                            <p class="text-sm text-gray-600 mt-2">Duration: {{ $lesson->video_length }}</p>
                        @endif
                    </div>
                @endif

                <!-- Documents Section -->
                @if($lesson->documents && count($lesson->documents) > 0)
                    <div class="mb-6">
                        <h3 class="text-lg font-medium mb-3">Lesson Documents</h3>
                        <div class="space-y-2">
                            @foreach($lesson->documents as $document)
                                <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                    <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <a href="{{ asset('storage/' . $document) }}"
                                       download
                                       class="text-blue-600 hover:text-blue-800 font-medium">
                                        {{ basename($document) }}
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Navigation -->
                <div class="flex justify-between items-center pt-6 border-t">
                    <div></div>
                    @if(\App\Models\Quizz::where('lesson_id', $lesson->id)->count() > 0)
                        <button onclick="nextStep()" class="btn btn-primary">
                            Start Quiz →
                        </button>
                    @else
                        <div class="text-gray-500">No quiz available for this lesson</div>
                    @endif
                </div>
            </div>
        @else
            <div class="lesson-card text-center">
                <p class="text-gray-500">No lessons found for this module.</p>
            </div>
        @endif
    </div>

    <!-- Step 2: Quiz Section -->
    <div class="step" id="step2">
        <!-- Timer Display Component -->
        <div id="quiz-timer-container" class="quiz-timer-container hidden">
            <div class="flex items-center justify-between mb-3">
                <span class="text-sm opacity-90">⏰ Time Remaining:</span>
                <div id="timer-display" class="timer-display">--:--</div>
            </div>
            <div class="timer-progress-bar">
                <div id="timer-progress-fill" class="timer-progress-fill" style="width: 100%"></div>
            </div>
        </div>

        <!-- Warning Alert -->
        <div id="timer-warning" class="timer-warning hidden">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.5 0L3.732 19c-.77.833.192 2.5 1.732 2.5z"></path>
            </svg>
            <span id="warning-message">
                Time is running out! Only <span id="warning-time">5 minutes</span> remaining.
            </span>
        </div>

        <!-- Timeout Alert -->
        <div id="timeout-alert" class="timer-expired hidden">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span>Time's up! Your quiz has been automatically submitted.</span>
        </div>

        <!-- Quiz Form -->
        <form id="quiz_form" method="POST">
            <div class="lesson-card">
                <!-- Navigation Header -->
                <div class="flex flex-row items-center justify-between w-full mb-8">
                    <button type="button" onclick="prevStep()" class="btn btn-secondary">
                        ← Previous
                    </button>
                    <button type="submit" id="submit-quiz-btn" class="btn btn-primary">
                        Submit Quiz
                    </button>
                </div>

                <!-- Loading State -->
                <div id="loading" class="hidden text-center py-8">
                    <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
                    <p class="mt-2 text-gray-600">Submitting your quiz...</p>
                </div>

                <!-- Quiz Questions -->
                <div id="selected_quiz">
                    @if($lessons->count() > 0)
                        @php
                            $lesson = $lessons->first();
                            $quizzes = \App\Models\Quizz::where('lesson_id', $lesson->id)->get();
                        @endphp

                        @if($quizzes->count() > 0)
                            <div class="mb-8">
                                <h2 class="text-xl font-bold text-gray-800">
                                    {{ $quizzes->count() }} Multiple Choice Questions
                                </h2>
                                <p class="text-gray-600 mt-1">Choose the best answer for each question</p>
                            </div>

                            <!-- Hidden Form Fields -->
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="quiz_total" value="{{ $quizzes->count() }}">
                            <input type="hidden" id="module_id" name="module_id" value="{{ $lesson->module_id }}">
                            <input type="hidden" id="lesson_id" name="lesson_id" value="{{ $lesson->id }}">

                            @foreach($quizzes as $index => $quiz)
                                <div class="mb-8">
                                    <!-- Question -->
                                    <div class="quiz-question">
                                        <div class="question-header">
                                            <span class="question-number">{{ $index + 1 }}.</span>
                                            <div class="question-text">{{ $quiz->question }}</div>
                                        </div>
                                    </div>

                                    <!-- Answer Options -->
                                    <fieldset>
                                        <legend class="sr-only">Question {{ $index + 1 }}</legend>
                                        <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">

                                        <div class="quiz-options-container">
                                            <label class="quiz-option" data-option="A">
                                                <input type="radio"
                                                       id="a_{{ $quiz->id }}"
                                                       name="options_{{ $quiz->id }}"
                                                       value="A"
                                                       required>
                                                <div class="option-content">
                                                    <span class="option-letter">A.</span>
                                                    <span class="option-text">{{ $quiz->answer_option_a }}</span>
                                                </div>
                                            </label>

                                            <label class="quiz-option" data-option="B">
                                                <input type="radio"
                                                       id="b_{{ $quiz->id }}"
                                                       name="options_{{ $quiz->id }}"
                                                       value="B"
                                                       required>
                                                <div class="option-content">
                                                    <span class="option-letter">B.</span>
                                                    <span class="option-text">{{ $quiz->answer_option_b }}</span>
                                                </div>
                                            </label>

                                            <label class="quiz-option" data-option="C">
                                                <input type="radio"
                                                       id="c_{{ $quiz->id }}"
                                                       name="options_{{ $quiz->id }}"
                                                       value="C"
                                                       required>
                                                <div class="option-content">
                                                    <span class="option-letter">C.</span>
                                                    <span class="option-text">{{ $quiz->answer_option_c }}</span>
                                                </div>
                                            </label>

                                            <label class="quiz-option" data-option="D">
                                                <input type="radio"
                                                       id="d_{{ $quiz->id }}"
                                                       name="options_{{ $quiz->id }}"
                                                       value="D"
                                                       required>
                                                <div class="option-content">
                                                    <span class="option-letter">D.</span>
                                                    <span class="option-text">{{ $quiz->answer_option_d }}</span>
                                                </div>
                                            </label>
                                        </div>
                                    </fieldset>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-8">
                                <p class="text-gray-500">No quiz questions found for this lesson.</p>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>

<script>
// FIXED Timer Management Class with Session Support
class QuizTimer {
    constructor() {
        this.timerInterval = null;
        this.remainingSeconds = 0;
        this.totalSeconds = 0;
        this.warningShown = false;
        this.settings = {};
        this.attemptId = null;
        this.sessionId = null; // Add session ID storage
    }

    async initialize(lessonId, userId) {
        try {
            console.log('🕐 Initializing timer for lesson:', lessonId, 'user:', userId);

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            if (!csrfToken) {
                console.error('❌ CSRF token not found');
                return;
            }

            console.log('📡 Starting quiz session...');

            // Use session-based API instead
            const response = await fetch('/api/quiz/start-session', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    lesson_id: lessonId,
                    user_id: userId,
                    module_id: document.getElementById('module_id')?.value,
                    expected_questions: document.querySelectorAll('[name^="options_"]').length || 1
                })
            });

            console.log('📡 API Response status:', response.status);

            if (!response.ok) {
                const errorText = await response.text();
                console.error('❌ API Error Response:', errorText);
                this.showError(`Session initialization failed (${response.status})`);
                return;
            }

            const data = await response.json();
            console.log('✅ Session API Response:', data);

            if (data.success) {
                this.sessionId = data.session_id; // Store session ID
                this.settings = data.timer_settings || { enabled: true, duration_minutes: 10 };

                // Add session_id to the form
                this.addSessionIdToForm(this.sessionId);

                if (this.settings.enabled && data.timer_expires_at) {
                    console.log('⏰ Timer is enabled, setting up countdown...');

                    const expiresAt = new Date(data.timer_expires_at);
                    const now = new Date();

                    this.remainingSeconds = Math.max(0, Math.floor((expiresAt.getTime() - now.getTime()) / 1000));
                    this.totalSeconds = this.settings.duration_seconds || (this.settings.duration_minutes * 60) || 600;

                    console.log('⏰ Timer setup:', {
                        remainingSeconds: this.remainingSeconds,
                        totalSeconds: this.totalSeconds,
                        sessionId: this.sessionId,
                        expiresAt: expiresAt.toLocaleString()
                    });

                    this.showTimerDisplay();
                    this.startTimer();
                } else {
                    console.log('📝 Timer disabled for this quiz');
                    this.hideTimerDisplay();
                }
            } else {
                console.error('❌ API returned success: false', data);
                this.showError(data.message || 'Failed to initialize session');
            }

        } catch (error) {
            console.error('💥 Timer initialization error:', error);
            this.showError('Connection error. Please refresh the page.');
        }
    }

    addSessionIdToForm(sessionId) {
        // Add session_id as hidden input to the form
        const form = document.getElementById('quiz_form');
        if (form && sessionId) {
            let sessionInput = document.getElementById('session_id_input');
            if (!sessionInput) {
                sessionInput = document.createElement('input');
                sessionInput.type = 'hidden';
                sessionInput.name = 'session_id';
                sessionInput.id = 'session_id_input';
                form.appendChild(sessionInput);
            }
            sessionInput.value = sessionId;
            console.log('✅ Added session_id to form:', sessionId);
        }
    }

    showTimerDisplay() {
        const timerContainer = document.getElementById('quiz-timer-container');
        if (timerContainer) {
            timerContainer.classList.remove('hidden');
            this.updateDisplay(); // Show initial time
        }
    }

    hideTimerDisplay() {
        const timerContainer = document.getElementById('quiz-timer-container');
        if (timerContainer) {
            timerContainer.classList.add('hidden');
        }
    }

    showError(message) {
        console.error('Timer Error:', message);
        // You can add a visual error message here if needed
    }

    startTimer() {
        if (this.remainingSeconds <= 0) {
            console.log('⏰ Timer already expired');
            this.handleTimeout();
            return;
        }

        console.log('▶️ Starting timer countdown...');
        this.timerInterval = setInterval(() => {
            this.remainingSeconds--;
            this.updateDisplay();

            // Show warning if configured
            if (this.settings.show_warning && !this.warningShown) {
                const warningSeconds = this.settings.warning_time_seconds || 300;
                if (this.remainingSeconds <= warningSeconds && this.remainingSeconds > 0) {
                    this.showWarning();
                }
            }

            if (this.remainingSeconds <= 0) {
                console.log('⏰ Timer expired!');
                this.handleTimeout();
            }
        }, 1000);
    }

    updateDisplay() {
        const minutes = Math.floor(this.remainingSeconds / 60);
        const seconds = this.remainingSeconds % 60;
        const displayTime = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

        const timerDisplay = document.getElementById('timer-display');
        if (timerDisplay) {
            timerDisplay.textContent = displayTime;
        }

        // Update progress bar
        const progressFill = document.getElementById('timer-progress-fill');
        if (progressFill && this.totalSeconds > 0) {
            const percentage = Math.max(0, (this.remainingSeconds / this.totalSeconds) * 100);
            progressFill.style.width = `${percentage}%`;

            // Change colors based on remaining time
            if (percentage <= 25) {
                progressFill.style.background = 'linear-gradient(90deg, #F44336, #E91E63)';
                if (timerDisplay) timerDisplay.className = 'timer-display text-red-400';
            } else if (percentage <= 50) {
                progressFill.style.background = 'linear-gradient(90deg, #FF9800, #FFC107)';
                if (timerDisplay) timerDisplay.className = 'timer-display text-orange-400';
            } else {
                progressFill.style.background = 'linear-gradient(90deg, #4CAF50, #8BC34A)';
                if (timerDisplay) timerDisplay.className = 'timer-display text-white';
            }
        }
    }

    showWarning() {
        this.warningShown = true;
        console.log('⚠️ Showing timer warning');

        const warningElement = document.getElementById('timer-warning');
        if (warningElement) {
            const warningMinutes = Math.ceil(this.remainingSeconds / 60);
            const warningTimeElement = document.getElementById('warning-time');
            if (warningTimeElement) {
                warningTimeElement.textContent = `${warningMinutes} minute${warningMinutes > 1 ? 's' : ''}`;
            }
            warningElement.classList.remove('hidden');

            // Auto-hide warning after 10 seconds
            setTimeout(() => {
                warningElement.classList.add('hidden');
            }, 10000);
        }
    }

    handleTimeout() {
        console.log('🚫 Handling timer expiration...');
        this.stop();

        // Show timeout alert
        const timeoutAlert = document.getElementById('timeout-alert');
        if (timeoutAlert) {
            timeoutAlert.classList.remove('hidden');
        }

        // Disable form inputs
        const form = document.getElementById('quiz_form');
        if (form) {
            const inputs = form.querySelectorAll('input:not([type="hidden"]), button');
            inputs.forEach(input => input.disabled = true);
        }

        // Auto-submit if enabled
        if (this.settings.auto_submit !== false) {
            setTimeout(() => {
                this.autoSubmitQuiz();
            }, 3000);
        }
    }

    async autoSubmitQuiz() {
        try {
            console.log('🔄 Auto-submitting quiz...');

            const form = document.getElementById('quiz_form');
            if (!form) {
                console.error('❌ Quiz form not found for auto-submission');
                return;
            }

            // Show loading
            document.getElementById('loading')?.classList.remove('hidden');
            document.getElementById('selected_quiz')?.classList.add('hidden');

            const formData = new FormData(form);

            // Ensure session_id is present
            if (this.sessionId) {
                formData.set('session_id', this.sessionId);
            } else {
                // Generate a fallback session ID
                const lessonId = document.getElementById('lesson_id')?.value;
                const userId = document.querySelector('input[name="user_id"]')?.value;
                const timestamp = Date.now();
                const sessionId = `timeout_${lessonId}_${userId}_${timestamp}`;
                formData.set('session_id', sessionId);
                console.log('Generated fallback session ID:', sessionId);
            }

            // Add timeout submission indicators
            formData.set('timeout_submission', 'true');

            // Log what we're sending
            console.log('Auto-submitting with data:', {
                session_id: formData.get('session_id'),
                user_id: formData.get('user_id'),
                lesson_id: formData.get('lesson_id'),
                module_id: formData.get('module_id')
            });

            const response = await fetch('/api/quiz/marking', {
                method: 'POST',
                headers: {
                    'X-Timeout-Submission': 'true',
                    'X-Submission-Type': 'timed_out',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                },
                body: formData
            });

            console.log('Auto-submit response status:', response.status);

            if (!response.ok) {
                const errorText = await response.text();
                console.error('Auto-submit HTTP error:', errorText);
                throw new Error(`Server error ${response.status}`);
            }

            const result = await response.json();
            console.log('Auto-submit result:', result);

            if (result.success) {
                console.log('✅ Auto-submission successful');
                alert('Time expired! Your quiz has been automatically submitted.');
                window.location.reload();
            } else {
                throw new Error(result.message || 'Auto-submission failed');
            }

        } catch (error) {
            console.error('💥 Auto-submit error:', error);
            alert(`Auto-submit failed: ${error.message}\n\nPage will reload for manual submission.`);

            // Reload page after 3 seconds to allow manual submission
            setTimeout(() => {
                window.location.reload();
            }, 3000);
        }
    }

    stop() {
        if (this.timerInterval) {
            clearInterval(this.timerInterval);
            this.timerInterval = null;
            console.log('⏹️ Timer stopped');
        }
    }
}

// Global variables
let quizTimer = null;
let currentStep = 1;

// Navigation Functions
function nextStep() {
    if (currentStep === 1) {
        document.getElementById('step1').classList.remove('active');
        document.getElementById('step2').classList.add('active');
        currentStep = 2;

        // Debug the form after it becomes visible
        setTimeout(() => {
            debugFormStructure();
        }, 500);

        // Start timer with longer delay to ensure everything is ready
        setTimeout(() => {
            console.log('📋 Step 2 is now active, starting timer...');
            startQuizTimer();
        }, 700);
    }
}

function prevStep() {
    if (currentStep === 2) {
        // Stop the timer when going back
        if (quizTimer) {
            console.log('🛑 Stopping timer due to step navigation');
            quizTimer.stop();
            quizTimer = null;
        }

        document.getElementById('step2').classList.remove('active');
        document.getElementById('step1').classList.add('active');
        currentStep = 1;

        // Reset alerts
        document.getElementById('timer-warning')?.classList.add('hidden');
        document.getElementById('timeout-alert')?.classList.add('hidden');
        document.getElementById('quiz-timer-container')?.classList.add('hidden');
    }
}

function startQuizTimer() {
    const lessonId = document.getElementById('lesson_id')?.value;
    const userId = document.querySelector('input[name="user_id"]')?.value;

    console.log('🚀 Starting quiz timer - Lesson:', lessonId, 'User:', userId);

    if (!lessonId || !userId) {
        console.error('❌ Missing lesson_id or user_id for timer');
        console.log('Available inputs:', {
            lesson_id: document.getElementById('lesson_id'),
            user_id: document.querySelector('input[name="user_id"]'),
            all_hidden_inputs: Array.from(document.querySelectorAll('input[type="hidden"]')).map(i => ({name: i.name, value: i.value}))
        });
        return;
    }

    // Stop any existing timer
    if (quizTimer) {
        console.log('🛑 Stopping existing timer');
        quizTimer.stop();
    }

    // Create and initialize new timer
    quizTimer = new QuizTimer();
    quizTimer.initialize(lessonId, userId);
}

// Debug function
function debugFormStructure() {
    console.log('=== FORM DEBUG ===');

    const form = document.getElementById('quiz_form');
    if (!form) {
        console.error('❌ Form not found!');
        return;
    }

    console.log('✅ Form found');

    const hiddenInputs = form.querySelectorAll('input[type="hidden"]');
    console.log('📋 Hidden inputs:', Array.from(hiddenInputs).map(i => ({name: i.name, value: i.value})));

    const questionInputs = form.querySelectorAll('input[name^="options_"]');
    console.log('❓ Question inputs found:', questionInputs.length);

    const lessonIdInput = document.getElementById('lesson_id');
    const userIdInput = document.querySelector('input[name="user_id"]');

    console.log('🔍 Required inputs:', {
        lesson_id: lessonIdInput ? lessonIdInput.value : 'NOT FOUND',
        user_id: userIdInput ? userIdInput.value : 'NOT FOUND'
    });
}

// Enhanced radio button interaction
function setupQuizInteractions() {
    const radioInputs = document.querySelectorAll('input[type="radio"]');

    radioInputs.forEach(radio => {
        radio.addEventListener('change', function() {
            const sameName = document.querySelectorAll(`input[name="${this.name}"]`);
            sameName.forEach(r => {
                r.closest('.quiz-option')?.classList.remove('selected');
            });

            this.closest('.quiz-option')?.classList.add('selected');
        });
    });
}

// FIXED Manual form submission with session support
function setupFormSubmission() {
    const form = document.getElementById('quiz_form');
    if (!form) return;

    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        console.log('📝 Manual quiz submission started');

        // Stop timer
        if (quizTimer) {
            quizTimer.stop();
        }

        // Show loading
        document.getElementById('loading')?.classList.remove('hidden');
        document.getElementById('selected_quiz')?.classList.add('hidden');

        try {
            const formData = new FormData(this);

            // Ensure session_id is present for manual submission
            if (quizTimer && quizTimer.sessionId) {
                formData.set('session_id', quizTimer.sessionId);
                console.log('Using timer session_id:', quizTimer.sessionId);
            } else {
                // Generate session ID if we don't have one
                const lessonId = document.getElementById('lesson_id')?.value;
                const userId = document.querySelector('input[name="user_id"]')?.value;
                const timestamp = Date.now();
                const sessionId = `manual_${lessonId}_${userId}_${timestamp}`;
                formData.set('session_id', sessionId);
                console.log('Generated session_id for manual submission:', sessionId);
            }

            // Debug form data
            console.log('Submitting form with data:', {
                session_id: formData.get('session_id'),
                user_id: formData.get('user_id'),
                lesson_id: formData.get('lesson_id'),
                module_id: formData.get('module_id')
            });

            // Check if we have any quiz answers
            let hasAnswers = false;
            for (let [key, value] of formData.entries()) {
                if (key.startsWith('options_')) {
                    hasAnswers = true;
                    break;
                }
            }

            if (!hasAnswers) {
                alert('Please answer at least one question before submitting.');
                document.getElementById('loading')?.classList.add('hidden');
                document.getElementById('selected_quiz')?.classList.remove('hidden');
                return;
            }

            const response = await fetch('/api/quiz/marking', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                },
                body: formData
            });

            console.log('Manual submission response status:', response.status);

            if (!response.ok) {
                const errorText = await response.text();
                console.error('Manual submission HTTP error:', errorText);
                throw new Error(`Server error ${response.status}`);
            }

            const result = await response.json();
            console.log('Manual submission result:', result);

            if (result.success) {
                console.log('✅ Quiz submitted successfully');
                alert(`Quiz submitted successfully!\nScore: ${result.pass_percentage}%\nStatus: ${result.pass_status}`);
                window.location.reload();
            } else {
                throw new Error(result.message || 'Submission failed');
            }
        } catch (error) {
            console.error('💥 Quiz submission error:', error);
            alert('Failed to submit quiz. Please try again.');

            // Re-enable form
            document.getElementById('loading')?.classList.add('hidden');
            document.getElementById('selected_quiz')?.classList.remove('hidden');

            // Restart timer if it was running and there's time left
            if (quizTimer && quizTimer.remainingSeconds > 0) {
                quizTimer.startTimer();
            }
        }
    });
}

// Initialize everything
document.addEventListener('DOMContentLoaded', function() {
    setupQuizInteractions();
    setupFormSubmission();

    document.getElementById('step1')?.classList.add('active');
    document.getElementById('step2')?.classList.remove('active');
});
</script>

</x-filament-panels::page>
