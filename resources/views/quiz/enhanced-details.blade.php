{{-- resources/views/quiz/enhanced-details.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-900">Quiz Attempt History</h2>

        @if($groupedAttempts->count() > 0)
            <div class="flex gap-3">
                <a href="{{ route('quiz.download-all-history', ['user_id' => $userId]) }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 text-sm font-medium transition-colors">
                    <i class="fas fa-download"></i>
                    Download All History
                </a>
            </div>
        @endif
    </div>

    @if($groupedAttempts->isEmpty())
        <div class="bg-white rounded-lg border border-gray-200 p-8 text-center">
            <i class="fas fa-inbox text-gray-400 text-4xl mb-4"></i>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No Quiz Attempts Found</h3>
            <p class="text-gray-600">You haven't attempted any quizzes yet.</p>
        </div>
    @else
        <div class="space-y-6">
            @foreach($groupedAttempts as $sessionId => $sessionData)
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
                    {{-- Session Header --}}
                    <div class="p-6 border-b border-gray-100 {{ $sessionData['status'] === 'PASSED' ? 'bg-gradient-to-r from-green-50 to-emerald-50' : 'bg-gradient-to-r from-red-50 to-pink-50' }}">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-1">
                                    {{ $sessionData['module_title'] }}
                                </h3>
                                <p class="text-sm text-gray-600 mb-3">
                                    <span class="font-medium">Lesson:</span> {{ $sessionData['lesson_title'] }}
                                </p>
                                <div class="flex items-center gap-4 text-sm text-gray-600">
                                    <span><i class="fas fa-calendar mr-1"></i> {{ $sessionData['attempted_at'] }}</span>
                                    <span><i class="fas fa-clock mr-1"></i> {{ $sessionData['duration'] }} duration</span>
                                    <span class="px-2 py-1 rounded-full text-xs font-medium {{ $sessionData['submission_type'] === 'Manual' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        <i class="fas {{ $sessionData['submission_type'] === 'Manual' ? 'fa-hand-paper' : 'fa-clock' }} mr-1"></i>
                                        {{ $sessionData['submission_type'] }} Submission
                                    </span>
                                </div>
                            </div>

                            {{-- Score and Download Section --}}
                            <div class="text-right">
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="px-4 py-2 rounded-lg font-bold text-xl {{ $sessionData['status'] === 'PASSED' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $sessionData['score_percentage'] }}%
                                    </div>
                                    <a href="{{ route('quiz.download-history', ['session_id' => $sessionId, 'user_id' => $userId]) }}"
                                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 text-sm font-medium transition-colors">
                                        <i class="fas fa-download"></i>
                                        Download
                                    </a>
                                </div>
                                <div class="text-sm text-gray-600">
                                    <div>{{ $sessionData['correct_answers'] }}/{{ $sessionData['total_questions'] }} correct -
                                        <span class="font-medium {{ $sessionData['status'] === 'PASSED' ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $sessionData['status'] }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Questions Detail Section --}}
                    <div class="p-6">
                        <button type="button" onclick="toggleDetails('details-{{ $loop->index }}')"
                                class="flex items-center justify-between w-full text-left mb-4">
                            <h4 class="font-medium text-gray-900 flex items-center gap-2">
                                <i class="fas fa-question-circle text-blue-500"></i>
                                Question Details ({{ $sessionData['total_questions'] }} questions)
                            </h4>
                            <i class="fas fa-chevron-down text-gray-400 transform transition-transform duration-200"
                               id="arrow-details-{{ $loop->index }}"></i>
                        </button>

                        <div id="details-{{ $loop->index }}" class="space-y-4 {{ $loop->first ? '' : 'hidden' }}">
                            @foreach($sessionData['attempts'] as $attemptIndex => $attempt)
                                @php
                                    $quiz = $attempt->quiz;
                                    if (!$quiz) continue;

                                    $wasAnswered = $attempt->was_answered ?? ($attempt->user_answer !== null && $attempt->user_answer !== 'UNANSWERED');
                                    $isCorrect = $attempt->auto_mark ?? false;
                                    $userAnswer = $attempt->user_answer ?? 'UNANSWERED';
                                @endphp

                                <div class="p-4 border rounded-lg {{ $isCorrect ? 'bg-green-50 border-green-200' : 'bg-red-50 border-red-200' }}">
                                    <div class="flex justify-between items-start mb-3">
                                        <span class="text-xs font-medium px-2 py-1 rounded-full {{ $isCorrect ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            <i class="fas {{ $isCorrect ? 'fa-check-circle' : ($wasAnswered ? 'fa-times-circle' : 'fa-question-circle') }} mr-1"></i>
                                            {{ $isCorrect ? 'CORRECT' : ($wasAnswered ? 'INCORRECT' : 'NOT ANSWERED') }}
                                        </span>
                                        <span class="text-xs text-gray-500">{{ $attempt->created_at->format('H:i:s A') }}</span>
                                    </div>

                                    <div class="mb-3">
                                        <h5 class="font-medium text-gray-900 mb-2">Question {{ $attemptIndex + 1 }}:</h5>
                                        <p class="text-gray-700 mb-3">{{ $quiz->question }}</p>

                                        {{-- Answer Options --}}
                                        @if($quiz->option_a)
                                            <div class="space-y-2">
                                                @foreach(['A' => $quiz->option_a, 'B' => $quiz->option_b, 'C' => $quiz->option_c, 'D' => $quiz->option_d] as $key => $option)
                                                    @if($option)
                                                        @php
                                                            $isUserAnswer = $userAnswer === $key;
                                                            $isCorrectAnswer = $attempt->correct_answer === $key;
                                                        @endphp

                                                        <div class="flex items-center p-2 rounded border {{
                                                            $isCorrectAnswer ? 'border-green-200 bg-green-50' :
                                                            ($isUserAnswer && !$isCorrectAnswer ? 'border-red-200 bg-red-50' : 'border-gray-200')
                                                        }}">
                                                            @if($isCorrectAnswer)
                                                                <i class="fas fa-check-circle text-green-600 mr-2"></i>
                                                                <span class="text-green-800 font-medium">{{ $key }}. {{ $option }}</span>
                                                                <span class="ml-auto text-xs bg-green-100 text-green-800 px-2 py-1 rounded">Correct Answer</span>
                                                            @elseif($isUserAnswer)
                                                                <i class="fas fa-times-circle text-red-600 mr-2"></i>
                                                                <span class="text-red-800 font-medium">{{ $key }}. {{ $option }}</span>
                                                                <span class="ml-auto text-xs bg-red-100 text-red-800 px-2 py-1 rounded">Your Answer</span>
                                                            @else
                                                                <span class="w-4 h-4 mr-2"></span>
                                                                <span class="text-gray-600">{{ $key }}. {{ $option }}</span>
                                                            @endif
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        @endif

                                        {{-- Special message for unanswered questions --}}
                                        @if(!$wasAnswered)
                                            <div class="mt-3 p-3 bg-yellow-50 border border-yellow-200 rounded">
                                                <i class="fas fa-exclamation-triangle text-yellow-600 mr-2"></i>
                                                <span class="text-yellow-800 font-medium">
                                                    No answer was provided{{ $sessionData['submission_type'] === 'Timeout' ? ' due to timeout' : '' }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>

                                    {{-- Explanation section (if available) --}}
                                    @if($quiz->explanation)
                                        <div class="text-xs text-gray-600 mt-3 p-2 bg-blue-50 border border-blue-200 rounded">
                                            <i class="fas fa-lightbulb mr-1 text-blue-600"></i>
                                            <strong>Explanation:</strong> {{ $quiz->explanation }}
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        {{-- Session Summary --}}
                        <div class="mt-6 pt-4 border-t border-gray-100">
                            <div class="flex justify-between items-center text-sm">
                                <div class="flex gap-6">
                                    <span class="text-green-600 font-medium">
                                        <i class="fas fa-check mr-1"></i> {{ $sessionData['correct_answers'] }} correct
                                    </span>
                                    <span class="text-red-600 font-medium">
                                        <i class="fas fa-times mr-1"></i> {{ $sessionData['total_questions'] - $sessionData['correct_answers'] }} incorrect
                                    </span>
                                </div>
                                <span class="text-gray-600">Completed in {{ $sessionData['duration'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<script>
function toggleDetails(detailsId) {
    const details = document.getElementById(detailsId);
    const arrow = document.getElementById('arrow-' + detailsId);

    if (details.classList.contains('hidden')) {
        details.classList.remove('hidden');
        arrow.classList.add('rotate-180');
    } else {
        details.classList.add('hidden');
        arrow.classList.remove('rotate-180');
    }
}

// Auto-expand first attempt details on load
document.addEventListener('DOMContentLoaded', function() {
    const firstDetails = document.querySelector('[id^="details-"]');
    if (firstDetails && !firstDetails.classList.contains('hidden')) {
        const detailsId = firstDetails.id;
        const arrow = document.getElementById('arrow-' + detailsId.split('-')[1]);
        if (arrow) {
            arrow.classList.add('rotate-180');
        }
    }
});
</script>
@endsection
