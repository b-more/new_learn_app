@php
    $attempts = \App\Models\AttemptAnswer::where('user_id', $record->user_id)
        ->select('attempt_group_id', 'created_at')
        ->distinct('attempt_group_id')
        ->orderBy('created_at', 'desc')
        ->get();
@endphp

<div>
    @foreach($attempts as $attempt)
        <div class="border-b-2 mb-4">
            <div class="text-sm font-bold">Attempt on {{ $attempt->created_at->format('Y-m-d H:i:s') }}</div>
            @php
                $answers = \App\Models\AttemptAnswer::where('attempt_group_id', $attempt->attempt_group_id)->get();
                $total = $answers->count();
                $correct = $answers->where('auto_mark', 1)->count();
                $percentage = $total > 0 ? round(($correct / $total) * 100, 2) : 0;
            @endphp
            <div class="text-sm">Score: {{ $correct }}/{{ $total }} ({{ $percentage }}%)</div>

            @foreach($answers as $answer)
                <div class="ml-4 mt-2">
                    <div class="text-xs">
                        <span class="font-bold">Question:</span>
                        {{ \App\Models\Quizz::find($answer->quiz_id)->question }}
                    </div>
                    <div class="text-xs">
                        <span class="font-bold">Answer:</span>
                        <span class="{{ $answer->auto_mark ? 'text-green-600' : 'text-red-500' }}">
                            {{ $answer->user_answer }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
</div>
