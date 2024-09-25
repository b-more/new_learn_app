<div class="font-bold text-center">
    {{ \App\Models\AttemptAnswer::where('user_id', auth()->user()->id)->count() }}
</div>
