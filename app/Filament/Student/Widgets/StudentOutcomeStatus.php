<?php

namespace App\Filament\Student\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentOutcome;

class StudentOutcomeStatus extends Widget
{
    protected string $view = 'filament.student.widgets.student-outcome-status';

    protected static ?int $sort = 1;

    public ?StudentOutcome $outcome = null;

    public function mount(): void
    {
        $student = Auth::guard('student')->user();

        $this->outcome = StudentOutcome::where('student_id', $student->id)->first();
    }
}
