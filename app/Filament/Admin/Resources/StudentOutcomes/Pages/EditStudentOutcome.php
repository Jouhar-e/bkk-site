<?php

namespace App\Filament\Admin\Resources\StudentOutcomes\Pages;

use App\Filament\Admin\Resources\StudentOutcomes\StudentOutcomeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditStudentOutcome extends EditRecord
{
    protected static string $resource = StudentOutcomeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
