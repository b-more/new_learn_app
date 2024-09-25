<?php

namespace App\Filament\Resources\QuizzResource\Pages;

use App\Filament\Resources\QuizzResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateQuizz extends CreateRecord
{
    protected static string $resource = QuizzResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['answer_option_a'] = "A. ".$data['answer_option_a'];
        $data['answer_option_b'] = "B. ".$data['answer_option_b'];
        $data['answer_option_c'] = "C. ".$data['answer_option_c'];
        $data['answer_option_d'] = "D. ".$data['answer_option_d'];

        return $data;
    }
}
