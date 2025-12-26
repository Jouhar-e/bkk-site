<?php

namespace App\Filament\Admin\Resources\Students\Pages;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Admin\Resources\Students\StudentResource;

class CreateStudent extends CreateRecord
{
    protected static string $resource = StudentResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['password'] = Hash::make(Str::random(10));
        $data['must_change_password'] = 1;
        return $data;
    }
}
