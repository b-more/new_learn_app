@php
    $attempts = \App\Models\AttemptAnswer::where('user_id', $record->user_id)
        ->select('attempt_group_id', 'module_id', 'lesson_id', 'created_at')
        ->distinct('attempt_group_id')
        ->orderBy('created_at', 'desc')
        ->get();
@endphp

<div class="space-y-4">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-bold">Quiz Attempt History</h2>
        <a href="{{ route('quiz.attempts.download', ['userId' => $record->user_id]) }}"
           class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition">
            Download PDF Report
        </a>
    </div>

    @foreach($attempts as $attempt)
        @php
            $module = \App\Models\Module::find($attempt->module_id);
            $lesson = \App\Models\Lesson::find($attempt->lesson_id);
            $answers = \App\Models\AttemptAnswer::where('attempt_group_id', $attempt->attempt_group_id)->get();
            $total = $answers->count();
            $correct = $answers->where('auto_mark', 1)->count();
            $percentage = $total > 0 ? round(($correct / $total) * 100, 2) : 0;
        @endphp

        <div class="border p-4 rounded-lg">
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <div class="text-sm text-gray-600">Module</div>
                    <div class="font-medium">{{ $module->title ?? 'Unknown Module' }}</div>
                </div>
                <div>
                    <div class="text-sm text-gray-600">Lesson</div>
                    <div class="font-medium">{{ $lesson->title ?? 'Unknown Lesson' }}</div>
                </div>
            </div>

            <div class="text-sm text-gray-600">
                Attempted on {{ $attempt->created_at->format('Y-m-d H:i:s') }}
            </div>

            <div class="mt-2 text-lg font-bold {{ $percentage >= 70 ? 'text-green-600' : 'text-red-600' }}">
                Score: {{ $correct }}/{{ $total }} ({{ $percentage }}%)
            </div>

            <div class="mt-4 space-y-3">
                @foreach($answers as $answer)
                    @php
                        $quiz = \App\Models\Quizz::find($answer->quiz_id);
                    @endphp
                    @if($quiz)
                        <div class="ml-4 p-3 bg-gray-50 rounded">
                            <div class="text-sm">
                                <span class="font-semibold">Question:</span>
                                {{ $quiz->question }}
                            </div>
                            <div class="text-sm mt-1">
                                <span class="font-semibold">Your Answer:</span>
                                <span class="{{ $answer->auto_mark ? 'text-green-600' : 'text-red-500' }} font-medium">
                                    {{ $answer->user_answer }}
                                </span>
                                @if(!$answer->auto_mark)
                                    <span class="text-gray-600 ml-2">(Correct: {{ $quiz->correct_answer }})</span>
                                @endif
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    @endforeach

    @if($attempts->isEmpty())
        <div class="text-gray-500 text-center py-4">
            No quiz attempts found.
        </div>
    @endif
</div>
