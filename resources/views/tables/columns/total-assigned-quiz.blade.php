<div class="text-center">
    {{ \Illuminate\Support\Facades\DB::table('module_user')->where('user_id', $getRecord->user_id)->count() }}
</div>
