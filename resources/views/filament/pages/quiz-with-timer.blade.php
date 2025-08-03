{{-- Enhanced Quiz Component with Timer --}}

<div class="w-full step" id="step2">
    {{-- Timer Display --}}
    <div id="quiz-timer-container" class="hidden mb-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-sm font-medium text-blue-700">Time Remaining:</span>
            </div>
            <div id="timer-display" class="text-lg font-bold text-blue-900">
                --:--
            </div>
        </div>
        <div id="timer-progress-bar" class="mt-2 w-full bg-blue-200 rounded-full h-2">
            <div id="timer-progress-fill" class="bg-blue-600 h-2 rounded-full transition-all duration-1000" style="width: 100%"></div>
        </div>
    </div>

    {{-- Warning Alert --}}
    <div id="timer-warning" class="hidden mb-4 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
        <div class="flex items-center">
            <svg class="w-5 h-5 text-yellow-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.5 0L3.732 19c-.77.833.192 2.5 1.732 2.5z"></path>
            </svg>
            <span class="text-yellow-800 font-medium" id="warning-message">
                Time is running out! Only <span id="warning-time">5 minutes</span> remaining.
            </span>
        </div>
    </div>

    {{-- Timeout Alert --}}
    <div id="timeout-alert" class="hidden mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
        <div class="flex items-center">
            <svg class="w-5 h-5 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="text-red-800 font-medium">
                Time's up! Your quiz has been automatically submitted.
            </span>
        </div>
    </div>

    <form id="quiz_form" method="POST">
        <div class="flex flex-row items-center justify-between w-full mb-8">
            <div>
                <button type="button" onclick="prevStep()" class="px-8 py-2 text-center text-white bg-green-800 rounded-full hover:bg-green-700 hover:cursor-pointer">Previous</button>
            </div>
            <div>
                <button type="submit" id="submit-quiz-btn" class="px-8 py-2 text-center text-white bg-green-800 rounded-full hover:bg-green-700 hover:cursor-pointer">Submit</button>
            </div>
        </div>

        <div id="loading" class="hidden">
            <div class="flex flex-col items-center justify-center">
                <dotlottie-player src="{{ asset('anims/shimmer.json') }}" background="transparent" speed="1" class="w-full h-[300px]" loop autoplay></dotlottie-player>
            </div>
        </div>

        <div id="selected_quiz" class="">
            <div class="mb-8 font-bold text-md">{{ \App\Models\Quizz::where('lesson_id',$lessons->first()->id ?? 0)->count() }} MULTIPLE CHOICE QUESTIONS</div>
            @foreach(\App\Models\Quizz::where('lesson_id',$lessons->first()->id ?? 0)->get() as $quiz)
                <div id="question_asked" class="p-6 mb-10 text-sm font-semibold bg-green-800 bg-opacity-10">{{ $quiz->question }}</div>
                <fieldset>
                    <legend class="sr-only">Multiple Choice Question</legend>
                    <input hidden name="user_id" value="{{ Auth::user()->id }}">
                    <input hidden name="quiz_id" value="{{ $quiz->id }}">
                    <input hidden name="quiz_total" value="{{ \App\Models\Quizz::where('lesson_id',$lessons->first()->id)->count() }}">
                    <input hidden id="module_id" name="module_id" value="{{ $lessons->first()->module_id }}">
                    <input hidden id="lesson_id" name="lesson_id" value="{{ $lessons->first()->id }}">

                    <div class="flex items-center mb-4">
                        <input id="a_{{ $quiz->id }}" type="radio" name="options_{{ $quiz->id }}" value="A" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" required>
                        <label for="a_{{ $quiz->id }}" class="block text-sm font-medium text-gray-900 ms-2 dark:text-gray-300">
                            A. {{ $quiz->answer_option_a }}
                        </label>
                    </div>

                    <div class="flex items-center mb-4">
                        <input id="b_{{ $quiz->id }}" type="radio" name="options_{{ $quiz->id }}" value="B" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" required>
                        <label for="b_{{ $quiz->id }}" class="block text-sm font-medium text-gray-900 ms-2 dark:text-gray-300">
                            B. {{ $quiz->answer_option_b }}
                        </label>
                    </div>

                    <div class="flex items-center mb-4">
                        <input id="c_{{ $quiz->id }}" type="radio" name="options_{{ $quiz->id }}" value="C" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" required>
                        <label for="c_{{ $quiz->id }}" class="block text-sm font-medium text-gray-900 ms-2 dark:text-gray-300">
                            C. {{ $quiz->answer_option_c }}
                        </label>
                    </div>

                    <div class="flex items-center mb-4">
                        <input id="d_{{ $quiz->id }}" type="radio" name="options_{{ $quiz->id }}" value="D" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" required>
                        <label for="d_{{ $quiz->id }}" class="block text-sm font-medium text-gray-900 ms-2 dark:text-gray-300">
                            D. {{ $quiz->answer_option_d }}
                        </label>
                    </div>
                </fieldset>
            @endforeach
        </div>
    </form>
</div>

<script>
// Quiz Timer Management
class QuizTimer {
    constructor() {
        this.timerInterval = null;
        this.remainingSeconds = 0;
        this.totalSeconds = 0;
        this.warningShown = false;
        this.settings = {};
        this.serverTimeOffset = 0;
    }

    async initialize(lessonId, userId) {
        try {
            // Start quiz attempt and get timer settings
            const response = await fetch('/api/start-quiz-attempt', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                },
                body: JSON.stringify({
                    lesson_id: lessonId,
                    user_id: userId
                })
            });

            const data = await response.json();

            if (data.success && data.timer_settings.enabled) {
                this.settings = data.timer_settings;

                // Calculate remaining time based on server time
                const serverTime = new Date(data.server_time);
                const expiresAt = new Date(data.timer_expires_at);
                const localTime = new Date();

                this.serverTimeOffset = serverTime.getTime() - localTime.getTime();
                this.remainingSeconds = Math.max(0, Math.floor((expiresAt.getTime() - localTime.getTime() - this.serverTimeOffset) / 1000));
                this.totalSeconds = this.settings.duration_seconds;

                this.startTimer();
                this.showTimerDisplay();
            }
        } catch (error) {
            console.error('Failed to initialize quiz timer:', error);
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

            // Show warning if enabled and time matches warning threshold
            if (this.settings.show_warning && !this.warningShown) {
                const warningSeconds = this.settings.warning_time_seconds;
                if (this.remainingSeconds <= warningSeconds && this.remainingSeconds > 0) {
                    this.showWarning();
                }
            }

            // Handle timeout
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

            // Change color based on remaining time
            if (this.remainingSeconds <= 300) { // 5 minutes
                timerDisplay.className = 'text-lg font-bold text-red-600';
            } else if (this.remainingSeconds <= 600) { // 10 minutes
                timerDisplay.className = 'text-lg font-bold text-orange-600';
            } else {
                timerDisplay.className = 'text-lg font-bold text-blue-900';
            }
        }

        // Update progress bar
        const progressFill = document.getElementById('timer-progress-fill');
        if (progressFill && this.totalSeconds > 0) {
            const percentage = (this.remainingSeconds / this.totalSeconds) * 100;
            progressFill.style.width = `${Math.max(0, percentage)}%`;

            // Change progress bar color
            if (percentage <= 25) {
                progressFill.className = 'bg-red-600 h-2 rounded-full transition-all duration-1000';
            } else if (percentage <= 50) {
                progressFill.className = 'bg-orange-600 h-2 rounded-full transition-all duration-1000';
            } else {
                progressFill.className = 'bg-blue-600 h-2 rounded-full transition-all duration-1000';
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

            // Auto-hide warning after 10 seconds
            setTimeout(() => {
                warningElement.classList.add('hidden');
            }, 10000);
        }
    }

    handleTimeout() {
        if (this.timerInterval) {
            clearInterval(this.timerInterval);
            this.timerInterval = null;
        }

        // Show timeout alert
        const timeoutAlert = document.getElementById('timeout-alert');
        if (timeoutAlert) {
            timeoutAlert.classList.remove('hidden');
        }

        // Disable form inputs
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
            }, 3000); // Give user 3 seconds to see the timeout message
        }
    }

    async autoSubmitQuiz() {
        const form = document.getElementById('quiz_form');
        if (form) {
            // Show loading
            document.getElementById('loading').classList.remove('hidden');
            document.getElementById('selected_quiz').classList.add('hidden');

            try {
                const formData = new FormData(form);
                const response = await fetch('/api/marking', {
                    method: 'POST',
                    body: formData
                });

                const result = await response.json();

                if (result.success) {
                    // Handle successful submission
                    window.location.reload(); // Or redirect to results page
                } else {
                    console.error('Auto-submit failed:', result.message);
                    alert('Failed to auto-submit quiz. Please try again.');
                }
            } catch (error) {
                console.error('Auto-submit error:', error);
                alert('Failed to auto-submit quiz. Please try again.');
            }
        }
    }

    stop() {
        if (this.timerInterval) {
            clearInterval(this.timerInterval);
            this.timerInterval = null;
        }
    }
}

// Initialize timer when quiz step is shown
let quizTimer = null;

function showQuizWithTimer() {
    const lessonId = document.getElementById('lesson_id')?.value;
    const userId = document.querySelector('input[name="user_id"]')?.value;

    if (lessonId && userId) {
        quizTimer = new QuizTimer();
        quizTimer.initialize(lessonId, userId);
    }
}

// Enhanced form submission with timer validation
document.getElementById('quiz_form').addEventListener('submit', async function(e) {
    e.preventDefault();

    // Stop timer
    if (quizTimer) {
        quizTimer.stop();
    }

    // Show loading
    document.getElementById('loading').classList.remove('hidden');
    document.getElementById('selected_quiz').classList.add('hidden');

    try {
        const formData = new FormData(this);
        const response = await fetch('/api/marking', {
            method: 'POST',
            body: formData
        });

        const result = await response.json();

        if (response.status === 408) {
            // Timer expired
            alert('Quiz time has expired. Your answers could not be submitted.');
            return;
        }

        if (result.success) {
            // Handle successful submission
            console.log('Quiz submitted successfully:', result);
            // You can redirect or show results here
            window.location.reload();
        } else {
            throw new Error(result.message);
        }
    } catch (error) {
        console.error('Quiz submission error:', error);
        alert('Failed to submit quiz. Please try again.');

        // Re-enable form
        document.getElementById('loading').classList.add('hidden');
        document.getElementById('selected_quiz').classList.remove('hidden');

        // Restart timer if it was running
        if (quizTimer && quizTimer.remainingSeconds > 0) {
            quizTimer.startTimer();
        }
    }
});

// Call this function when the quiz step becomes visible
// You'll need to integrate this with your existing step navigation
document.addEventListener('DOMContentLoaded', function() {
    // If quiz is immediately visible, initialize timer
    const quizStep = document.getElementById('step2');
    if (quizStep && !quizStep.classList.contains('hidden')) {
        showQuizWithTimer();
    }
});
</script>
