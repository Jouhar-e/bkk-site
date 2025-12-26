<?php

namespace App\Filament\Admin\Resources\Students\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;

class StudentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nisn')
                    ->required()
                    ->unique(ignoreRecord: true),

                TextInput::make('name')
                    ->required(),

                Select::make('major_id')
                    ->relationship('major', 'name')
                    ->required(),

                Select::make('level')
                    ->options([
                        'siswa' => 'Siswa',
                        'alumni' => 'Alumni',
                    ])
                    ->required(),

                TextInput::make('graduation_year')->numeric(),
                TextInput::make('email')->email(),
                TextInput::make('phone')->tel(),

                Toggle::make('is_active')->default(true),
            ]);
    }
}
