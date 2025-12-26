<?php

namespace App\Filament\Admin\Resources\BkkProfiles\Pages;

use App\Filament\Admin\Resources\BkkProfiles\BkkProfileResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBkkProfiles extends ListRecords
{
    protected static string $resource = BkkProfileResource::class;

}
