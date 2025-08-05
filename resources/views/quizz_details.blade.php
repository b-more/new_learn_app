{{-- Enhanced Quiz Details with Comprehensive Information --}}
@php
    // Get additional context for better display
    $groupedQuizzes = collect($quizzes)->groupBy(function($quiz) {
        return $quiz->lesson_id . '_' . $quiz->created_at->format('Y-m-d_H-i');
    });
@endphp

<div class="space-y-6">
    @foreach($groupedQuizzes as $sessionId => $sessionQuizzes)
        @php
            $firstQuiz = $sessionQuizzes->first();
            $module = \App\Models\Module::find($firstQuiz->module_id);
            $lesson = \App\Models\Lesson::find($firstQuiz->lesson_id);
            $total = $sessionQuizzes->count();
            $passed = $sessionQuizzes->where('auto_mark', 1)->count();
            $failed = $total - $passed;
            $percentage = $total > 0 ? round(($passed / $total) * 100, 2) : 0;

            // Calculate session timing
            $startTime = $sessionQuizzes->min('created_at');
            $endTime = $sessionQuizzes->max('updated_at');
            $duration = $startTime->diffInSeconds($endTime);

            // Check if any questions were unanswered
            $unanswered = $sessionQuizzes->where('user_answer', 'UNANSWERED')->count();
            $answered = $total - $unanswered;

            // Determine submission type
            $submissionType = $firstQuiz->attempt_status ?? 'completed';
            $isTimeout = $submissionType === 'timeout';
        @endphp

        <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
            {{-- Session Header --}}
            <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-indigo-50">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 mb-1">
                            {{ $module->title ?? 'Unknown Module' }}
                        </h3>
                        <p class="text-sm text-gray-600 mb-3">
                            <span class="font-medium">Lesson:</span> {{ $lesson->title ?? 'Unknown Lesson' }}
                        </p>

                        {{-- Session Stats --}}
                        <div class="flex flex-wrap gap-4 text-sm">
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                <span class="text-gray-700">{{ $total }} questions</span>
                            </div>

                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700">{{ $answered }} answered</span>
                            </div>

                            @if($unanswered > 0)
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-gray-700">{{ $unanswered }} unanswered</span>
                            </div>
                            @endif

                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-gray-700">{{ gmdate('i:s', $duration) }} duration</span>
                            </div>
                        </div>
                    </div>

                    {{-- Overall Score --}}
                    <div class="text-right">
                        <div class="inline-flex items-center px-4 py-2 rounded-full text-lg font-bold
                            {{ $percentage >= 70 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $percentage }}%
                        </div>
                        <div class="text-sm text-gray-600 mt-1">
                            {{ $passed }}/{{ $total }} correct
                        </div>
                        <div class="text-xs text-gray-500 mt-1">
                            {{ $percentage >= 70 ? 'PASSED' : 'FAILED' }}
                        </div>
                    </div>
                </div>

                {{-- Submission Info --}}
                <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                    <div class="text-sm text-gray-600">
                        <span class="font-medium">Attempted:</span> {{ $startTime->format('M j, Y g:i A') }}
                    </div>
                    <div class="flex items-center gap-2">
                        @if($isTimeout)
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-700">
                                🕐 Auto-submitted (Timeout)
                            </span>
                        @else
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                ✅ Manual Submission
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Questions List --}}
            <div class="p-6">
                <div class="space-y-4">
                    @foreach($sessionQuizzes->sortBy('created_at') as $index => $quiz)
                        @php
                            $question = \App\Models\Quizz::find($quiz->quiz_id);
                            $wasAnswered = $quiz->user_answer !== 'UNANSWERED' && !empty($quiz->user_answer);
                            $isCorrect = $quiz->auto_mark == 1;

                            // Determine status colors and icons
                            if (!$wasAnswered) {
                                $statusClass = 'border-orange-200 bg-orange-50';
                                $statusIcon = '❓';
                                $statusText = 'Not Answered';
                                $statusColor = 'text-orange-700';
                            } elseif ($isCorrect) {
                                $statusClass = 'border-green-200 bg-green-50';
                                $statusIcon = '✅';
                                $statusText = 'Correct';
                                $statusColor = 'text-green-700';
                            } else {
                                $statusClass = 'border-red-200 bg-red-50';
                                $statusIcon = '❌';
                                $statusText = 'Incorrect';
                                $statusColor = 'text-red-700';
                            }
                        @endphp

                        <div class="border rounded-lg p-4 {{ $statusClass }}">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex items-center gap-3">
                                    <span class="flex items-center justify-center w-8 h-8 rounded-full bg-gray-100 text-sm font-bold text-gray-700">
                                        {{ $index + 1 }}
                                    </span>
                                    <div>
                                        <span class="text-lg">{{ $statusIcon }}</span>
                                        <span class="ml-2 font-medium {{ $statusColor }}">{{ $statusText }}</span>
                                    </div>
                                </div>

                                @if($quiz->created_at)
                                    <div class="text-xs text-gray-500">
                                        {{ $quiz->created_at->format('g:i:s A') }}
                                    </div>
                                @endif
                            </div>

                            {{-- Question Text --}}
                            @if($question)
                                <div class="mb-4">
                                    <div class="text-sm font-medium text-gray-900 mb-2">Question:</div>
                                    <div class="text-sm text-gray-700 bg-white p-3 rounded border">
                                        {{ $question->question }}
                                    </div>
                                </div>

                                {{-- Answer Details --}}
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <span class="font-medium text-gray-600">Your Answer:</span>
                                        <div class="mt-1">
                                            @if($wasAnswered)
                                                <span class="inline-flex items-center px-2 py-1 rounded {{ $isCorrect ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                    {{ $quiz->user_answer }}
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2 py-1 rounded bg-orange-100 text-orange-800">
                                                    No answer provided
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div>
                                        <span class="font-medium text-gray-600">Correct Answer:</span>
                                        <div class="mt-1">
                                            <span class="inline-flex items-center px-2 py-1 rounded bg-green-100 text-green-800">
                                                {{ $quiz->correct_answer }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                {{-- Answer Options (if available) --}}
                                @if($question->answer_option_a)
                                    <div class="mt-4">
                                        <div class="text-xs font-medium text-gray-600 mb-2">Available Options:</div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-xs">
                                            <div class="flex items-center gap-2">
                                                <span class="font-medium">A:</span>
                                                <span class="text-gray-700">{{ $question->answer_option_a }}</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span class="font-medium">B:</span>
                                                <span class="text-gray-700">{{ $question->answer_option_b }}</span>
                                            </div>
                                            @if($question->answer_option_c)
                                            <div class="flex items-center gap-2">
                                                <span class="font-medium">C:</span>
                                                <span class="text-gray-700">{{ $question->answer_option_c }}</span>
                                            </div>
                                            @endif
                                            @if($question->answer_option_d)
                                            <div class="flex items-center gap-2">
                                                <span class="font-medium">D:</span>
                                                <span class="text-gray-700">{{ $question->answer_option_d }}</span>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @else
                                <div class="text-sm text-gray-500 italic">Question details not available</div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Session Summary Footer --}}
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                <div class="flex justify-between items-center text-sm">
                    <div class="flex items-center gap-4">
                        <span class="text-gray-600">Session Summary:</span>
                        <span class="text-green-600 font-medium">{{ $passed }} correct</span>
                        <span class="text-red-600 font-medium">{{ $failed }} incorrect</span>
                        @if($unanswered > 0)
                            <span class="text-orange-600 font-medium">{{ $unanswered }} unanswered</span>
                        @endif
                    </div>
                    <div class="text-gray-500">
                        Completed in {{ gmdate('i:s', $duration) }}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
