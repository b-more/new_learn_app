<div>
    @foreach($quizzes as $index => $quiz)
        <div class="flex flex-row items-start space-x-3 mb-3">
            <div class="text-lg font-bold">{{ $index + 1 }}</div>
            <div class="border-b-2">
                <div class="text-xs"><span class="font-bold">Module: </span>{{ \App\Models\Module::where('id', $quiz->module_id)->first()->title ?? "" }}</div>
                <div class="text-sm"><span class="font-bold">Question: </span>{{ \App\Models\Quizz::where('id', $quiz->lesson_id)->first()->question ?? "" }}</div>
                <div class="text-sm"><span class="font-bold">Mark: </span>@if($quiz->auto_mark == 1)<span class="text-md font-bold text-green-600">PASS</span>@else<span class="text-md font-bold text-red-500">FAIL</span>@endif</div>
            </div>
        </div>

    @endforeach
</div>
