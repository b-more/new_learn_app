{{-- Enhanced Quiz Attempt History with Detailed Timings --}}
@php
    // Group attempts by attempt_group_id or by lesson_id and created_at (within 5 minutes)
    $attempts = \App\Models\AttemptAnswer::where('user_id', $record->user_id)
        ->with(['quiz', 'lesson', 'module'])
        ->orderBy('created_at', 'desc')
        ->get()
        ->groupBy(function($item) {
            // Group by attempt_group_id if it exists, otherwise by lesson_id and date
            return $item->attempt_group_id ?? $item->lesson_id . '_' . $item->created_at->format('Y-m-d_H-i');
        });
@endphp

<div class="space-y-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold text-gray-900">Quiz Attempt History</h2>
        <div class="flex gap-3">
            <a href="{{ route('quiz.attempts.download', ['userId' => $record->user_id]) }}"
               class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Download PDF Report
            </a>
        </div>
    </div>

    @if($attempts->isEmpty())
        <div class="text-center py-12 bg-gray-50 rounded-lg">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No quiz attempts found</h3>
            <p class="mt-1 text-sm text-gray-500">This user hasn't attempted any quizzes yet.</p>
        </div>
    @else
        @foreach($attempts as $groupId => $groupedAnswers)
            @php
                $firstAnswer = $groupedAnswers->first();
                $lastAnswer = $groupedAnswers->sortBy('created_at')->last();
                $module = $firstAnswer->module ?? \App\Models\Module::find($firstAnswer->module_id);
                $lesson = $firstAnswer->lesson ?? \App\Models\Lesson::find($firstAnswer->lesson_id);

                $total = $groupedAnswers->count();
                $correct = $groupedAnswers->where('auto_mark', 1)->count();
                $answered = $groupedAnswers->where('was_answered', true)->count() ?? $total; // fallback if field doesn't exist
                $unanswered = $total - $answered;
                $percentage = $total > 0 ? round(($correct / $total) * 100, 2) : 0;

                // Calculate timing details
                $startTime = $firstAnswer->attempt_started_at ?? $firstAnswer->created_at;
                $endTime = $lastAnswer->attempt_completed_at ?? $lastAnswer->created_at;
                $duration = $startTime->diffInSeconds($endTime);
                $timerExpiry = $firstAnswer->timer_expires_at;
                $submissionType = $firstAnswer->attempt_status ?? 'unknown';

                // Determine submission status
                $isTimeoutSubmission = $submissionType === 'timeout';
                $wasTimedQuiz = !is_null($timerExpiry);

                // Status colors
                $statusColor = $percentage >= 70 ? 'text-green-600' : 'text-red-600';
                $statusBg = $percentage >= 70 ? 'bg-green-50 border-green-200' : 'bg-red-50 border-red-200';
                $submissionTypeColor = $isTimeoutSubmission ? 'text-orange-600 bg-orange-50' : 'text-blue-600 bg-blue-50';
            @endphp

            <div class="bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow duration-200">
                {{-- Header Section --}}
                <div class="p-6 border-b border-gray-100">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 mb-1">
                                {{ $module->title ?? 'Unknown Module' }}
                            </h3>
                            <p class="text-sm text-gray-600 mb-2">
                                <span class="font-medium">Lesson:</span> {{ $lesson->title ?? 'Unknown Lesson' }}
                            </p>
                            <div class="flex items-center gap-4 text-sm text-gray-500">
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0h6m-6 0l2 2m-2-2v10a2 2 0 002 2h2a2 2 0 002-2V9m-6 0l-2-2"></path>
                                    </svg>
                                    Attempt #{{ $loop->iteration }}
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $startTime->format('M j, Y g:i A') }}
                                </span>
                            </div>
                        </div>

                        {{-- Score Badge --}}
                        <div class="text-right">
                            <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $statusBg }} {{ $statusColor }} mb-2">
                                {{ $percentage >= 70 ? 'PASSED' : 'FAILED' }} - {{ $percentage }}%
                            </div>
                            <div class="text-sm text-gray-600">
                                {{ $correct }}/{{ $total }} correct
                            </div>
                        </div>
                    </div>

                    {{-- Quick Stats Row --}}
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                        <div class="bg-gray-50 rounded-lg p-3">
                            <div class="text-gray-500">Questions</div>
                            <div class="font-semibold text-gray-900">{{ $total }}</div>
                        </div>
                        <div class="bg-green-50 rounded-lg p-3">
                            <div class="text-gray-500">Answered</div>
                            <div class="font-semibold text-green-600">{{ $answered }}</div>
                        </div>
                        @if($unanswered > 0)
                        <div class="bg-orange-50 rounded-lg p-3">
                            <div class="text-gray-500">Unanswered</div>
                            <div class="font-semibold text-orange-600">{{ $unanswered }}</div>
                        </div>
                        @endif
                        <div class="bg-blue-50 rounded-lg p-3">
                            <div class="text-gray-500">Duration</div>
                            <div class="font-semibold text-blue-600">{{ gmdate('i:s', $duration) }}</div>
                        </div>
                    </div>
                </div>

                {{-- Timing Details Section --}}
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-100">
                    <h4 class="font-medium text-gray-900 mb-3 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Timing Details
                    </h4>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                        <div>
                            <span class="text-gray-500">Started:</span>
                            <div class="font-medium">{{ $startTime->format('g:i:s A') }}</div>
                            <div class="text-xs text-gray-400">{{ $startTime->format('M j, Y') }}</div>
                        </div>

                        <div>
                            <span class="text-gray-500">Completed:</span>
                            <div class="font-medium">{{ $endTime->format('g:i:s A') }}</div>
                            <div class="text-xs text-gray-400">{{ $endTime->format('M j, Y') }}</div>
                        </div>

                        <div>
                            <span class="text-gray-500">Submission Type:</span>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $submissionTypeColor }}">
                                    @if($isTimeoutSubmission)
                                        🕐 Auto-submitted (Timeout)
                                    @elseif($submissionType === 'completed')
                                        ✅ Manual Submission
                                    @else
                                        ❓ {{ ucfirst($submissionType) }}
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>

                    @if($wasTimedQuiz)
                        <div class="mt-4 p-3 bg-blue-50 rounded-lg border border-blue-200">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-blue-700 font-medium">Timer Information:</span>
                                <div class="text-right">
                                    <div class="text-blue-900">
                                        Allowed: {{ gmdate('i:s', $timerExpiry->diffInSeconds($startTime)) }}
                                    </div>
                                    <div class="text-xs text-blue-600">
                                        @if($isTimeoutSubmission)
                                            Expired at {{ $timerExpiry->format('g:i:s A') }}
                                        @else
                                            {{ gmdate('i:s', max(0, $timerExpiry->diffInSeconds($endTime))) }} remaining
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Questions Detail Section --}}
                <div class="p-6">
                    <button type="button" onclick="toggleDetails('details-{{ $loop->index }}')"
                            class="flex items-center justify-between w-full text-left">
                        <h4 class="font-medium text-gray-900 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Question Details ({{ $total }} questions)
                        </h4>
                        <svg class="w-5 h-5 text-gray-400 transform transition-transform duration-200"
                             id="arrow-details-{{ $loop->index }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <div id="details-{{ $loop->index }}" class="mt-4 space-y-3 hidden">
                        @foreach($groupedAnswers->sortBy('created_at') as $answer)
                            @php
                                $quiz = $answer->quiz ?? \App\Models\Quizz::find($answer->quiz_id);
                                $wasAnsweredByUser = $answer->was_answered ?? ($answer->user_answer !== 'UNANSWERED');
                            @endphp
                            @if($quiz)
                                <div class="p-4 border rounded-lg {{ $answer->auto_mark ? 'bg-green-50 border-green-200' : 'bg-red-50 border-red-200' }}">
                                    <div class="flex justify-between items-start mb-2">
                                        <span class="text-xs font-medium {{ $answer->auto_mark ? 'text-green-700' : 'text-red-700' }}">
                                            Question {{ $loop->iteration }}
                                        </span>
                                        <div class="flex items-center gap-2">
                                            @if(!$wasAnsweredByUser)
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-700">
                                                    Not Answered
                                                </span>
                                            @endif
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $answer->auto_mark ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                                {{ $answer->auto_mark ? 'CORRECT' : 'INCORRECT' }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="text-sm text-gray-700 mb-3">
                                        <span class="font-medium">Q:</span> {{ $quiz->question }}
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                                        <div>
                                            <span class="text-gray-500">Your Answer:</span>
                                            <span class="ml-2 font-medium {{ $answer->auto_mark ? 'text-green-600' : 'text-red-600' }}">
                                                @if($wasAnsweredByUser)
                                                    {{ $answer->user_answer }}
                                                @else
                                                    <span class="text-orange-600">Not Answered</span>
                                                @endif
                                            </span>
                                        </div>
                                        @if(!$answer->auto_mark)
                                            <div>
                                                <span class="text-gray-500">Correct Answer:</span>
                                                <span class="ml-2 font-medium text-green-600">{{ $quiz->correct_answer }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    @if($answer->created_at)
                                        <div class="mt-2 text-xs text-gray-400">
                                            Answered at {{ $answer->created_at->format('g:i:s A') }}
                                        </div>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>

<script>
function toggleDetails(detailsId) {
    const details = document.getElementById(detailsId);
    const arrow = document.getElementById('arrow-' + detailsId);

    if (details.classList.contains('hidden')) {
        details.classList.remove('hidden');
        arrow.style.transform = 'rotate(180deg)';
    } else {
        details.classList.add('hidden');
        arrow.style.transform = 'rotate(0deg)';
    }
}
</script>
