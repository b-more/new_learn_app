<?php

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
        return [
            User::where('id',$reports->user_id)->first()->name ?? "",
            User::where('id',$reports->user_id)->first()->modules->count(),
            AttemptAnswer::where('user_id',$reports->user_id)->count(),
            AttemptAnswer::where('user_id', $reports->user_id)->where('auto_mark',1)->count() ?? 0,
            AttemptAnswer::where('user_id', $reports->user_id)->where('auto_mark',0)->count(),
            $reports->updated_at
        ];
    }
}


