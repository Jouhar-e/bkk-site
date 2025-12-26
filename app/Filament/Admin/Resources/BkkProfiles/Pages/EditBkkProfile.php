<?php

namespace App\Filament\Admin\Resources\BkkProfiles\Pages;

use App\Filament\Admin\Resources\BkkProfiles\BkkProfileResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBkkProfile extends EditRecord
{
    protected static string $resource = BkkProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
