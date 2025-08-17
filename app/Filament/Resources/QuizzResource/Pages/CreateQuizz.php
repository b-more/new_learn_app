<?php

namespace App\Filament\Resources\QuizzResource\Pages;

use App\Filament\Resources\QuizzResource;
use App\Models\Quizz;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Log;

class CreateQuizz extends CreateRecord
{
    protected static string $resource = QuizzResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function beforeCreate(): void
    {
        $this->saveQuizz($this->form->getState());
    }

    public function saveQuizz(array $data)
    {
        foreach ($data['questions'] as $questionData) {
            Quizz::create([
                'lesson_id' => $data['lesson_id'],
                'question' => $questionData['question'],
                'correct_answer' => $questionData['correct_answer'],
                'answer_option_a' => $questionData['answer_option_a'],
                'answer_option_b' => $questionData['answer_option_b'],
                'answer_option_c' => $questionData['answer_option_c'],
                'answer_option_d' => $questionData['answer_option_d'],
                'duration' => "4", // optional field
            ]);
        }

        Notification::make()
            ->success()
            ->title('Quiz Questions Added')
            ->body('Successfully added quiz questions')
            ->persistent()
            ->send();

        $this->redirect('/course/quizzs');
        $this->halt();


    }
}
