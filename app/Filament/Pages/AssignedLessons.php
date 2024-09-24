<?php

namespace App\Filament\Pages;

use App\Models\Lesson;
use App\Models\Module;
use Filament\Pages\Page;

class AssignedLessons extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.assigned-lessons';

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public function __construct()
    {
        $this->id = request()->get('b');
        $this->module_title = $this->getModuleTitle();
        $this->lessons = $this->getLessons();
    }

    function getModuleTitle()
    {
        return Module::where('id',$this->id)->first()->title ?? "";
    }

    function getLessons()
    {
        return Lesson::where('module_id',$this->id)->get();
    }

    public $id;
    public $module_title;
    public $lessons;
}
