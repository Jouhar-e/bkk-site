<?php

namespace App\Filament\Admin\Resources\StudentOutcomes\Pages;

use App\Filament\Admin\Resources\StudentOutcomes\StudentOutcomeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListStudentOutcomes extends ListRecords
{
    protected static string $resource = StudentOutcomeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
