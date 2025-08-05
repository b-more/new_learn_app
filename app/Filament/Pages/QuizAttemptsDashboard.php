<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\AttemptAnswer;
use App\Models\User;

class QuizAttemptsDashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    protected static string $view = 'filament.pages.quiz-attempts-dashboard';

    protected static ?string $navigationLabel = 'Quiz Dashboard';

    protected static ?string $title = 'Quiz Performance Dashboard';

    protected static ?string $navigationGroup = 'Analytics';

    protected static ?int $navigationSort = 1;

    // Make these public properties for Livewire
    public $selectedUserId;
    public $users;
    public $selectedUser; // Add this as a public property

    public function mount(): void
    {
        // Get users who have attempt answers (using the alternative approach)
        $userIds = AttemptAnswer::distinct('user_id')->pluck('user_id');
        $this->users = User::whereIn('id', $userIds)->get();

        // Set default user (first user or admin)
        $this->selectedUserId = $this->users->first()?->id ?? auth()->id();

        // Set the selectedUser property
        $this->selectedUser = $this->users->firstWhere('id', $this->selectedUserId);
    }

    public function updatedSelectedUserId()
    {
        // Update selectedUser when selection changes
        $this->selectedUser = User::find($this->selectedUserId);

        // This will refresh the component when user selection changes
        $this->dispatch('user-changed');
    }

    // Make the record property available (to match your blade template expectations)
    public function getRecordProperty()
    {
        return (object)[
            'user_id' => $this->selectedUserId,
            'name' => $this->selectedUser?->name ?? 'Unknown User',
            'created_at' => $this->selectedUser?->created_at ?? now()
        ];
    }
}
