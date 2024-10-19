<div class="text-center">
     {{ \Illuminate\Support\Facades\DB::table('module_user')->where('user_id', auth()->id())->count() }}
</div>

