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
// Timer Management Class - FIXED VERSION
class QuizTimer {
    constructor() {
        this.timerInterval = null;
        this.remainingSeconds = 0;
        this.totalSeconds = 0;
        this.warningShown = false;
        this.settings = {};
    }

    async initialize(lessonId, userId) {
        try {
            console.log('Initializing timer for lesson:', lessonId);

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            if (!csrfToken) {
                console.error('CSRF token not found');
                return;
            }

            const response = await fetch('/api/start-quiz-attempt', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    lesson_id: lessonId,
                    user_id: userId
                })
            });

            if (!response.ok) {
                console.error('Timer initialization failed with status:', response.status);
                return;
            }

            const data = await response.json();
            console.log('Timer response:', data);

            if (data.success && data.timer_settings.enabled) {
                this.settings = data.timer_settings;

                const serverTime = new Date(data.server_time);
                const expiresAt = new Date(data.timer_expires_at);

                this.remainingSeconds = Math.max(0, Math.floor((expiresAt.getTime() - Date.now()) / 1000));
                this.totalSeconds = this.settings.duration_seconds;

                this.showTimerDisplay();
                this.startTimer();
            }
        } catch (error) {
            console.error('Timer initialization failed:', error);
        }
    }

    startTimer() {
        if (this.remainingSeconds <= 0) {
            this.handleTimeout();
            return;
        }

        this.timerInterval = setInterval(() => {
            this.remainingSeconds--;
            this.updateDisplay();

            if (this.settings.show_warning && !this.warningShown) {
                if (this.remainingSeconds <= this.settings.warning_time_seconds) {
                    this.showWarning();
                }
            }

            if (this.remainingSeconds <= 0) {
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

        const progressFill = document.getElementById('timer-progress-fill');
        if (progressFill && this.totalSeconds > 0) {
            const percentage = (this.remainingSeconds / this.totalSeconds) * 100;
            progressFill.style.width = `${Math.max(0, percentage)}%`;

            if (percentage <= 10) {
                progressFill.style.background = 'linear-gradient(90deg, #F44336, #E91E63)';
            } else if (percentage <= 25) {
                progressFill.style.background = 'linear-gradient(90deg, #FF9800, #FFC107)';
            } else {
                progressFill.style.background = 'linear-gradient(90deg, #4CAF50, #8BC34A)';
            }
        }
    }

    showTimerDisplay() {
        const timerContainer = document.getElementById('quiz-timer-container');
        if (timerContainer) {
            timerContainer.classList.remove('hidden');
        }
    }

    showWarning() {
        this.warningShown = true;
        const warningElement = document.getElementById('timer-warning');
        const warningTimeElement = document.getElementById('warning-time');

        if (warningElement && warningTimeElement) {
            const warningMinutes = Math.ceil(this.settings.warning_time_seconds / 60);
            warningTimeElement.textContent = `${warningMinutes} minute${warningMinutes > 1 ? 's' : ''}`;
            warningElement.classList.remove('hidden');

            setTimeout(() => {
                warningElement.classList.add('hidden');
            }, 10000);
        }
    }

    handleTimeout() {
        if (this.timerInterval) {
            clearInterval(this.timerInterval);
        }

        const timeoutAlert = document.getElementById('timeout-alert');
        if (timeoutAlert) {
            timeoutAlert.classList.remove('hidden');
        }

        // Disable form
        const form = document.getElementById('quiz_form');
        if (form) {
            const inputs = form.querySelectorAll('input, button');
            inputs.forEach(input => {
                if (input.type !== 'hidden') {
                    input.disabled = true;
                }
            });
        }

        // Auto-submit if enabled
        if (this.settings.auto_submit) {
            setTimeout(() => {
                this.autoSubmitQuiz();
            }, 3000);
        }
    }

    // async autoSubmitQuiz() {
    //     console.log('=== AUTO SUBMIT STARTED ===');

    //     const form = document.getElementById('quiz_form');
    //     if (!form) {
    //         console.error('Quiz form not found');
    //         return;
    //     }

    //     // Show loading
    //     document.getElementById('loading')?.classList.remove('hidden');
    //     document.getElementById('selected_quiz')?.classList.add('hidden');

    //     try {
    //         const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    //         if (!csrfToken) {
    //             throw new Error('CSRF token not found');
    //         }

    //         // Get all radio inputs and group by question
    //         const radioInputs = form.querySelectorAll('input[type="radio"]');
    //         const questionGroups = {};

    //         radioInputs.forEach(radio => {
    //             if (radio.name.startsWith('options_')) {
    //                 const quizId = radio.name.replace('options_', '');
    //                 if (!questionGroups[quizId]) {
    //                     questionGroups[quizId] = {
    //                         name: radio.name,
    //                         hasAnswer: false,
    //                         elements: []
    //                     };
    //                 }
    //                 questionGroups[quizId].elements.push(radio);
    //                 if (radio.checked) {
    //                     questionGroups[quizId].hasAnswer = true;
    //                 }
    //             }
    //         });

    //         console.log('Question groups found:', questionGroups);

    //         // Create FormData manually
    //         const formData = new FormData();

    //         // Add hidden fields
    //         const hiddenInputs = form.querySelectorAll('input[type="hidden"]');
    //         hiddenInputs.forEach(input => {
    //             if (input.name && input.value) {
    //                 formData.append(input.name, input.value);
    //             }
    //         });

    //         // Add radio button answers or UNANSWERED for unanswered questions
    //         let answeredCount = 0;
    //         let unansweredCount = 0;

    //         Object.keys(questionGroups).forEach(quizId => {
    //             const checkedRadio = questionGroups[quizId].elements.find(radio => radio.checked);
    //             if (checkedRadio) {
    //                 // User answered this question
    //                 formData.append(checkedRadio.name, checkedRadio.value);
    //                 console.log(`User answered: ${checkedRadio.name} = ${checkedRadio.value}`);
    //                 answeredCount++;
    //             } else {
    //                 // User didn't answer - mark as UNANSWERED (will be marked wrong)
    //                 formData.append(`options_${quizId}`, 'UNANSWERED');
    //                 console.log(`Unanswered question: options_${quizId} = UNANSWERED`);
    //                 unansweredCount++;
    //             }
    //         });

    //         // Debug: Log final FormData
    //         console.log('Final FormData contents:');
    //         for (let [key, value] of formData.entries()) {
    //             console.log(`${key}: ${value}`);
    //         }

    //         console.log(`Summary: ${answeredCount} answered, ${unansweredCount} unanswered`);

    //         const response = await fetch('/api/marking', {
    //             method: 'POST',
    //             headers: {
    //                 'X-CSRF-TOKEN': csrfToken,
    //                 'Accept': 'application/json',
    //             },
    //             body: formData
    //         });

    //         console.log('Response status:', response.status);

    //         if (response.status === 408) {
    //             alert(`Quiz time expired!\n\nAnswered: ${answeredCount}\nUnanswered: ${unansweredCount}\n\nUnanswered questions were marked as incorrect.`);
    //             window.location.reload();
    //             return;
    //         }

    //         if (response.status === 422) {
    //             const errorData = await response.json();
    //             console.error('Validation errors:', errorData);
    //             alert('Validation failed during auto-submission.');
    //             return;
    //         }

    //         if (!response.ok) {
    //             const errorText = await response.text();
    //             console.error('Auto-submit failed:', response.status, errorText);
    //             throw new Error(`Server error: ${response.status}`);
    //         }

    //         const result = await response.json();
    //         console.log('Auto-submit result:', result);

    //         if (result.success) {
    //             const score = result.pass_percentage || 0;
    //             const status = result.pass_status || 'Unknown';

    //             alert(`Quiz auto-submitted due to timeout!\n\nScore: ${score}%\nStatus: ${status}\n\nAnswered: ${answeredCount}\nUnanswered: ${unansweredCount} (marked incorrect)`);

    //             setTimeout(() => {
    //                 window.location.reload();
    //             }, 2000);
    //         } else {
    //             throw new Error(result.message || 'Auto-submission failed');
    //         }

    //     } catch (error) {
    //         console.error('Auto-submit error:', error);
    //         alert(`Auto-submit failed: ${error.message}\n\nPage will reload for manual submission.`);

    //         setTimeout(() => {
    //             window.location.reload();
    //         }, 3000);
    //     }
    // }

    async autoSubmitQuiz() {
    console.log('=== AUTO SUBMIT STARTED ===');

    const form = document.getElementById('quiz_form');
    if (!form) {
        console.error('Quiz form not found');
        return;
    }

    // Show loading
    document.getElementById('loading')?.classList.remove('hidden');
    document.getElementById('selected_quiz')?.classList.add('hidden');

    try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        if (!csrfToken) {
            throw new Error('CSRF token not found');
        }

        // Get all radio inputs and group by question
        const radioInputs = form.querySelectorAll('input[type="radio"]');
        const questionGroups = {};

        radioInputs.forEach(radio => {
            if (radio.name.startsWith('options_')) {
                const quizId = radio.name.replace('options_', '');
                if (!questionGroups[quizId]) {
                    questionGroups[quizId] = {
                        name: radio.name,
                        hasAnswer: false,
                        elements: []
                    };
                }
                questionGroups[quizId].elements.push(radio);
                if (radio.checked) {
                    questionGroups[quizId].hasAnswer = true;
                }
            }
        });

        console.log('Question groups found:', questionGroups);

        // Create FormData manually
        const formData = new FormData();

        // Add hidden fields
        const hiddenInputs = form.querySelectorAll('input[type="hidden"]');
        hiddenInputs.forEach(input => {
            if (input.name && input.value) {
                formData.append(input.name, input.value);
            }
        });

        // Add radio button answers or UNANSWERED for unanswered questions
        let answeredCount = 0;
        let unansweredCount = 0;

        Object.keys(questionGroups).forEach(quizId => {
            const checkedRadio = questionGroups[quizId].elements.find(radio => radio.checked);
            if (checkedRadio) {
                // User answered this question
                formData.append(checkedRadio.name, checkedRadio.value);
                console.log(`User answered: ${checkedRadio.name} = ${checkedRadio.value}`);
                answeredCount++;
            } else {
                // User didn't answer - mark as UNANSWERED (will be marked wrong)
                formData.append(`options_${quizId}`, 'UNANSWERED');
                console.log(`Unanswered question: options_${quizId} = UNANSWERED`);
                unansweredCount++;
            }
        });

        // Debug: Log final FormData
        console.log('Final FormData contents:');
        for (let [key, value] of formData.entries()) {
            console.log(`${key}: ${value}`);
        }

        console.log(`Summary: ${answeredCount} answered, ${unansweredCount} unanswered`);

        const response = await fetch('/api/marking', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
                'X-Timeout-Submission': 'true', // Indicate this is a timeout submission
                'X-Submission-Type': 'timed_out', // Use your model's status value
            },
            body: formData
        });

        console.log('Response status:', response.status);

        if (response.status === 408) {
            alert(`Quiz time expired!\n\nAnswered: ${answeredCount}\nUnanswered: ${unansweredCount}\n\nUnanswered questions were marked as incorrect.`);
            window.location.reload();
            return;
        }

        if (response.status === 422) {
            const errorData = await response.json();
            console.error('Validation errors:', errorData);
            alert('Validation failed during auto-submission.');
            return;
        }

        if (!response.ok) {
            const errorText = await response.text();
            console.error('Auto-submit failed:', response.status, errorText);
            throw new Error(`Server error: ${response.status}`);
        }

        const result = await response.json();
        console.log('Auto-submit result:', result);

        if (result.success) {
            const score = result.pass_percentage || 0;
            const status = result.pass_status || 'Unknown';
            const answered = result.answered_questions || answeredCount;
            const unanswered = result.unanswered_questions || unansweredCount;

            alert(`Quiz auto-submitted due to timeout!\n\nScore: ${score}%\nStatus: ${status}\n\nAnswered: ${answered} questions\nUnanswered: ${unanswered} questions (marked incorrect)\n\nNote: Only answered questions could earn points.`);

            setTimeout(() => {
                window.location.reload();
            }, 2000);
        } else {
            throw new Error(result.message || 'Auto-submission failed');
        }

    } catch (error) {
        console.error('Auto-submit error:', error);
        alert(`Auto-submit failed: ${error.message}\n\nPage will reload for manual submission.`);

        setTimeout(() => {
            window.location.reload();
        }, 3000);
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

        startQuizTimer();
    }
}

function prevStep() {
    if (currentStep === 2) {
        if (quizTimer?.timerInterval) {
            clearInterval(quizTimer.timerInterval);
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

    console.log('Starting timer - Lesson:', lessonId, 'User:', userId);

    if (lessonId && userId) {
        quizTimer = new QuizTimer();
        quizTimer.initialize(lessonId, userId);
    } else {
        console.log('Timer not started - missing lesson_id or user_id');
    }
}

// Debug function
function debugFormStructure() {
    console.log('=== FORM DEBUG ===');

    const form = document.getElementById('quiz_form');
    if (!form) {
        console.error('Form not found!');
        return;
    }

    const radioInputs = form.querySelectorAll('input[type="radio"]');
    console.log('Radio inputs found:', radioInputs.length);

    radioInputs.forEach(radio => {
        console.log(`Radio: name="${radio.name}", value="${radio.value}", checked=${radio.checked}`);
    });

    // Test FormData
    const testFormData = new FormData(form);
    console.log('Current FormData:');
    for (let [key, value] of testFormData.entries()) {
        console.log(`${key}: ${value}`);
    }
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

// Manual form submission - FIXED VERSION
function setupFormSubmission() {
    const form = document.getElementById('quiz_form');
    if (!form) return;

    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        console.log('=== MANUAL SUBMIT ===');

        if (quizTimer?.timerInterval) {
            clearInterval(quizTimer.timerInterval);
        }

        document.getElementById('loading')?.classList.remove('hidden');
        document.getElementById('selected_quiz')?.classList.add('hidden');

        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            if (!csrfToken) {
                throw new Error('CSRF token not found');
            }

            const formData = new FormData(this);

            // Debug form data
            console.log('Manual submit FormData:');
            for (let [key, value] of formData.entries()) {
                console.log(`${key}: ${value}`);
            }

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

            const response = await fetch('/api/marking', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: formData
            });

            const result = await response.json();
            console.log('Manual submit result:', result);

            if (response.status === 408) {
                alert('Quiz time has expired. Your answers could not be submitted.');
                return;
            }

            if (response.status === 422) {
                console.error('Validation errors:', result);
                alert('Please check your answers and try again.');
                return;
            }

            if (result.success) {
                const score = result.pass_percentage || 0;
                const status = result.pass_status || 'Unknown';
                alert(`Quiz submitted successfully!\n\nScore: ${score}%\nStatus: ${status}`);
                window.location.reload();
            } else {
                throw new Error(result.message || 'Submission failed');
            }

        } catch (error) {
            console.error('Manual submission error:', error);
            alert(`Failed to submit quiz: ${error.message}\n\nPlease try again.`);

            document.getElementById('loading')?.classList.add('hidden');
            document.getElementById('selected_quiz')?.classList.remove('hidden');

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
