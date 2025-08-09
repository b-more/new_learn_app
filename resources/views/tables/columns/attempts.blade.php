{{-- resources/views/tables/columns/attempts.blade.php --}}
@php
    use App\Models\AttemptAnswer;
    use Illuminate\Support\Facades\Log;

    $userId = $getRecord()->user_id;

    // Simple session count - much cleaner than complex grouping!
    $sessionCount = AttemptAnswer::getUserSessionCount($userId);

    // Optional: Log for debugging (remove after testing)
    Log::info('Attempts View: Session-based count', [
        'user_id' => $userId,
        'session_count' => $sessionCount,
        'timestamp' => now()
    ]);
@endphp

<div class="font-bold text-center">
    {{ $sessionCount }}
</div>
