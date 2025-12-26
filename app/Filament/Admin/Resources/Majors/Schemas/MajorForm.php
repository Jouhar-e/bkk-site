<?php

namespace App\Filament\Admin\Resources\Majors\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;

class MajorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->label('Kode')
                    ->required()
                    ->maxLength(10)
                    ->unique(ignoreRecord: true),

                TextInput::make('name')
                    ->label('Nama Jurusan')
                    ->required()
                    ->maxLength(255),
            ]);
    }
}
