{{-- resources/views/tables/columns/passes.blade.php --}}
@php
    use App\Models\AttemptAnswer;

    $userId = $getRecord()->user_id;
    $passedCount = AttemptAnswer::getUserPassedSessionsCount($userId);
@endphp

<div class="text-success text-center">
    {{ $passedCount }}
</div>
