<div class="text-danger-600 text-center">
    {{ \App\Models\AttemptAnswer::where('user_id', auth()->user()->id)->where('auto_mark',0)->count() }}
</div>
