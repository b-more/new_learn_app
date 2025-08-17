{{-- resources/views/quizz_details.blade.php - Fixed for Filament Compatibility --}}

@php
    // Get all attempts for this user with proper relationships
    $allAttempts = \App\Models\AttemptAnswer::where('user_id', $quizzes->first()->user_id ?? 0)
        ->with(['quiz', 'lesson', 'module'])
        ->orderBy('created_at', 'desc')
        ->get();

    // Group attempts by session (lesson + time proximity)
    $groupedAttempts = $allAttempts->groupBy(function($attempt) {
        return $attempt->lesson_id . '_' . $attempt->created_at->format('Y-m-d_H-i');
    });
@endphp

{{-- Main Container with Filament-compatible styling --}}
<div class="quiz-details-container">
    <style>
        /* Filament-specific styles to prevent layout conflicts */
        .quiz-details-container {
            max-width: 100%;
            margin: 0;
            padding: 0;
        }

        .quiz-session-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        }

        .quiz-header {
            padding: 1.5rem;
            border-bottom: 1px solid #f3f4f6;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        }

        .quiz-header.passed {
            background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 100%);
        }

        .quiz-header.failed {
            background: linear-gradient(135deg, #fef2f2 0%, #fef2f2 100%);
        }

        .quiz-content {
            padding: 1.5rem;
        }

        .score-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 600;
            font-size: 1.125rem;
        }

        .score-badge.passed {
            background-color: #dcfce7;
            color: #166534;
        }

        .score-badge.failed {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .download-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background-color: #3b82f6;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: background-color 0.2s;
        }

        .download-btn:hover {
            background-color: #2563eb;
            color: white;
        }

        .question-toggle {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: none;
            border: none;
            padding: 0.75rem 0;
            font-weight: 500;
            color: #374151;
            cursor: pointer;
        }

        .question-details {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #f3f4f6;
        }

        .question-card {
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .question-card.correct {
            background-color: #f0fdf4;
            border-color: #bbf7d0;
        }

        .question-card.incorrect {
            background-color: #fef2f2;
            border-color: #fecaca;
        }

        .answer-option {
            display: flex;
            align-items: center;
            padding: 0.5rem;
            margin: 0.25rem 0;
            border-radius: 4px;
            border: 1px solid #e5e7eb;
        }

        .answer-option.correct {
            background-color: #f0fdf4;
            border-color: #bbf7d0;
            color: #166534;
        }

        .answer-option.user-wrong {
            background-color: #fef2f2;
            border-color: #fecaca;
            color: #991b1b;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-badge.correct {
            background-color: #dcfce7;
            color: #166534;
        }

        .status-badge.incorrect {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .status-badge.timeout {
            background-color: #fef3c7;
            color: #d97706;
        }

        .hidden {
            display: none;
        }

        .rotate-180 {
            transform: rotate(180deg);
        }

        .transition-transform {
            transition: transform 0.2s ease;
        }
    </style>

    @if($groupedAttempts->isEmpty())
        <div style="text-align: center; padding: 3rem; background: #f9fafb; border-radius: 8px; color: #6b7280;">
            <svg style="width: 3rem; height: 3rem; margin: 0 auto 1rem; color: #d1d5db;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <h3 style="font-weight: 500; margin-bottom: 0.5rem;">No Quiz Attempts Found</h3>
            <p>This user hasn't attempted any quizzes yet.</p>
        </div>
    @else
        {{-- Header Summary --}}
        <div style="margin-bottom: 2rem; padding: 1rem; background: #f8fafc; border-radius: 8px; border: 1px solid #e2e8f0;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h3 style="font-size: 1.125rem; font-weight: 600; color: #1f2937; margin: 0 0 0.5rem 0;">Quiz Attempt Summary</h3>
                    <p style="color: #6b7280; margin: 0;">Total Sessions: {{ $groupedAttempts->count() }} | Total Questions Answered: {{ $allAttempts->count() }}</p>
                </div>
                <a href="#" onclick="downloadAllHistory()" class="download-btn">
                    <svg style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Download All History
                </a>
            </div>
        </div>

        {{-- Session Details --}}
        @foreach($groupedAttempts as $sessionId => $sessionAttempts)
            @php
                $firstAttempt = $sessionAttempts->first();
                $module = $firstAttempt->module ?? \App\Models\Module::find($firstAttempt->module_id);
                $lesson = $firstAttempt->lesson ?? \App\Models\Lesson::find($firstAttempt->lesson_id);

                $totalQuestions = $sessionAttempts->count();
                $correctAnswers = $sessionAttempts->where('auto_mark', 1)->count();
                $scorePercentage = $totalQuestions > 0 ? round(($correctAnswers / $totalQuestions) * 100, 2) : 0;
                $isPassed = $scorePercentage >= 70;

                $startTime = $sessionAttempts->min('created_at');
                $endTime = $sessionAttempts->max('updated_at');
                $duration = $startTime->diffInSeconds($endTime);
                $durationFormatted = gmdate('H:i:s', $duration);

                $submissionType = $firstAttempt->attempt_status ?? 'completed';
                $isTimeout = in_array($submissionType, ['timeout', 'timed_out', 'expired']);
            @endphp

            <div class="quiz-session-card">
                {{-- Session Header --}}
                <div class="quiz-header {{ $isPassed ? 'passed' : 'failed' }}">
                    <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem;">
                        <div style="flex: 1;">
                            <h3 style="font-size: 1.125rem; font-weight: 600; color: #1f2937; margin: 0 0 0.5rem 0;">
                                {{ $module->title ?? 'Unknown Module' }}
                            </h3>
                            <p style="color: #6b7280; margin: 0 0 0.75rem 0;">
                                <strong>Lesson:</strong> {{ $lesson->title ?? 'Unknown Lesson' }}
                            </p>
                            <div style="display: flex; gap: 1rem; font-size: 0.875rem; color: #6b7280;">
                                <span>📅 {{ $startTime->format('M j, Y H:i A') }}</span>
                                <span>⏱️ {{ $durationFormatted }}</span>
                                <span class="status-badge {{ $isTimeout ? 'timeout' : 'correct' }}">
                                    {{ $isTimeout ? '⏰ Timeout Submission' : '✋ Manual Submission' }}
                                </span>
                            </div>
                        </div>

                        {{-- Score Section --}}
                        <div style="text-align: right;">
                            <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 0.5rem;">
                                <div class="score-badge {{ $isPassed ? 'passed' : 'failed' }}">
                                    {{ $scorePercentage }}%
                                </div>
                                <a href="#" onclick="downloadSession('{{ $sessionId }}')" class="download-btn">
                                    <svg style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Download
                                </a>
                            </div>
                            <div style="font-size: 0.875rem; color: #6b7280;">
                                {{ $correctAnswers }}/{{ $totalQuestions }} correct -
                                <span style="font-weight: 500; color: {{ $isPassed ? '#16a34a' : '#dc2626' }};">
                                    {{ $isPassed ? 'PASSED' : 'FAILED' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Questions Section --}}
                <div class="quiz-content">
                    <button type="button" onclick="toggleQuestions('questions-{{ $loop->index }}')" class="question-toggle">
                        <span style="display: flex; align-items: center; gap: 0.5rem;">
                            <svg style="width: 1.25rem; height: 1.25rem; color: #3b82f6;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Question Details ({{ $totalQuestions }} questions)
                        </span>
                        <svg id="arrow-questions-{{ $loop->index }}" style="width: 1.25rem; height: 1.25rem; color: #9ca3af;" class="transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <div id="questions-{{ $loop->index }}" class="question-details {{ $loop->first ? '' : 'hidden' }}">
                        @foreach($sessionAttempts->sortBy('quiz_id') as $attemptIndex => $attempt)
                            @php
                                $quiz = $attempt->quiz ?? \App\Models\Quizz::find($attempt->quiz_id);
                                if (!$quiz) continue;

                                $userAnswer = $attempt->user_answer ?? 'UNANSWERED';
                                $correctAnswer = $attempt->correct_answer ?? $quiz->correct_answer;
                                $isCorrect = $attempt->auto_mark ?? false;
                                $wasAnswered = $userAnswer !== 'UNANSWERED' && !empty($userAnswer);
                            @endphp

                            <div class="question-card {{ $isCorrect ? 'correct' : 'incorrect' }}">
                                <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 0.75rem;">
                                    <span class="status-badge {{ $isCorrect ? 'correct' : 'incorrect' }}">
                                        {{ $isCorrect ? '✅ CORRECT' : ($wasAnswered ? '❌ INCORRECT' : '⚠️ NOT ANSWERED') }}
                                    </span>
                                    <span style="font-size: 0.75rem; color: #6b7280;">
                                        {{ $attempt->created_at->format('H:i:s A') }}
                                    </span>
                                </div>

                                <div>
                                    <h5 style="font-weight: 500; color: #1f2937; margin: 0 0 0.75rem 0;">
                                        Question {{ $attemptIndex + 1 }}: {{ $quiz->question }}
                                    </h5>

                                    {{-- Answer Options --}}
                                    @if($quiz->answer_option_a || $quiz->option_a)
                                        <div style="margin-bottom: 0.75rem;">
                                            @php
                                                $options = [
                                                    'A' => $quiz->answer_option_a ?? $quiz->option_a,
                                                    'B' => $quiz->answer_option_b ?? $quiz->option_b,
                                                    'C' => $quiz->answer_option_c ?? $quiz->option_c,
                                                    'D' => $quiz->answer_option_d ?? $quiz->option_d,
                                                ];
                                            @endphp

                                            @foreach($options as $key => $option)
                                                @if($option)
                                                    @php
                                                        $isUserAnswer = $userAnswer === $key;
                                                        $isCorrectOption = $correctAnswer === $key;
                                                    @endphp

                                                    <div class="answer-option {{ $isCorrectOption ? 'correct' : ($isUserAnswer ? 'user-wrong' : '') }}">
                                                        @if($isCorrectOption)
                                                            <span style="margin-right: 0.5rem;">✅</span>
                                                        @elseif($isUserAnswer)
                                                            <span style="margin-right: 0.5rem;">❌</span>
                                                        @else
                                                            <span style="width: 1rem; margin-right: 0.5rem;"></span>
                                                        @endif

                                                        <span style="flex: 1;">{{ $key }}. {{ $option }}</span>

                                                        @if($isCorrectOption)
                                                            <span style="font-size: 0.75rem; background: #dcfce7; color: #166534; padding: 0.25rem 0.5rem; border-radius: 4px;">Correct</span>
                                                        @elseif($isUserAnswer)
                                                            <span style="font-size: 0.75rem; background: #fee2e2; color: #991b1b; padding: 0.25rem 0.5rem; border-radius: 4px;">Your Answer</span>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif

                                    {{-- Unanswered Message --}}
                                    @if(!$wasAnswered)
                                        <div style="padding: 0.75rem; background: #fef3c7; border: 1px solid #fbbf24; border-radius: 6px; margin-top: 0.75rem;">
                                            <span style="color: #d97706; font-weight: 500;">
                                                ⚠️ No answer provided{{ $isTimeout ? ' due to timeout' : '' }}
                                            </span>
                                        </div>
                                    @endif

                                    {{-- Explanation --}}
                                    @if($quiz->explanation)
                                        <div style="padding: 0.75rem; background: #dbeafe; border: 1px solid #60a5fa; border-radius: 6px; margin-top: 0.75rem; font-size: 0.875rem;">
                                            <strong style="color: #1d4ed8;">💡 Explanation:</strong>
                                            <span style="color: #1e40af;">{{ $quiz->explanation }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Session Summary --}}
                    <div style="margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid #f3f4f6;">
                        <div style="display: flex; justify-content: space-between; align-items: center; font-size: 0.875rem;">
                            <div style="display: flex; gap: 1.5rem;">
                                <span style="color: #16a34a; font-weight: 500;">
                                    ✅ {{ $correctAnswers }} correct
                                </span>
                                <span style="color: #dc2626; font-weight: 500;">
                                    ❌ {{ $totalQuestions - $correctAnswers }} incorrect
                                </span>
                            </div>
                            <span style="color: #6b7280;">
                                Completed in {{ $durationFormatted }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>

<script>
function toggleQuestions(questionsId) {
    const questionsDiv = document.getElementById(questionsId);
    const arrow = document.getElementById('arrow-' + questionsId);

    if (questionsDiv.classList.contains('hidden')) {
        questionsDiv.classList.remove('hidden');
        arrow.classList.add('rotate-180');
    } else {
        questionsDiv.classList.add('hidden');
        arrow.classList.remove('rotate-180');
    }
}

function downloadSession(sessionId) {
    alert('Download functionality for session: ' + sessionId + '\nThis would generate a detailed report for this quiz session.');
    // Implement your download logic here
}

function downloadAllHistory() {
    alert('Download All History functionality\nThis would generate a comprehensive report of all quiz attempts.');
    // Implement your download logic here
}

// Auto-expand first session on load
document.addEventListener('DOMContentLoaded', function() {
    const firstArrow = document.querySelector('[id^="arrow-questions-0"]');
    if (firstArrow) {
        firstArrow.classList.add('rotate-180');
    }
});
</script>
