{{-- resources/views/tables/columns/fails.blade.php --}}
@php
    use App\Models\AttemptAnswer;

    $userId = $getRecord()->user_id;
    $failedCount = AttemptAnswer::getUserFailedSessionsCount($userId);
@endphp

<div class="text-danger-600 text-center">
    {{ $failedCount }}
</div>
