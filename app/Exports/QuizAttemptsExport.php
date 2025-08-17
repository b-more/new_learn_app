<?php

// app/Exports/QuizAttemptsExport.php
namespace App\Exports;

use App\Models\AttemptAnswer;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class QuizAttemptsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $reports;

    public function __construct($reports)
    {
        $this->reports = $reports;

        Log::info('QuizAttemptsExport: Session-based export initiated', [
            'total_records' => $reports->count(),
            'user_ids' => $reports->pluck('user_id')->unique()->values()->toArray()
        ]);
    }

    public function collection()
    {
        return $this->reports;
    }

    public function headings(): array
    {
        return [
            'user',
            'assigned_quiz',
            'attempts',
            'passes',
            'fails',
            'attempted_on'
        ];
    }

    public function map($reports): array
    {
        $user = User::where('id', $reports->user_id)->first();

        if (!$user) {
            return [
                'Unknown User',
                0,
                0,
                0,
                0,
                $reports->updated_at
            ];
        }

        // Simple session-based counting - much cleaner!
        $sessionCount = AttemptAnswer::getUserSessionCount($reports->user_id);
        $passedCount = AttemptAnswer::getUserPassedSessionsCount($reports->user_id);
        $failedCount = AttemptAnswer::getUserFailedSessionsCount($reports->user_id);

        return [
            $user->name,
            $user->modules->count(),
            $sessionCount,
            $passedCount,
            $failedCount,
            $reports->updated_at
        ];
    }
}
