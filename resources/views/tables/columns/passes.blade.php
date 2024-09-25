<div class="text-success text-center">
    {{ \App\Models\AttemptAnswer::where('user_id', auth()->user()->id)->where('auto_mark',1)->count() }}
</div>
