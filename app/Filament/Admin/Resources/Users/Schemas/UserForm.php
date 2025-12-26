<?php

namespace App\Filament\Admin\Resources\Users\Schemas;

use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama')
                    ->required(),

                TextInput::make('email')
                    ->email()
                    ->required(),

                Select::make('role')
                    ->options([
                        'super_admin' => 'Super Admin',
                        'staff' => 'Staff',
                        'guru' => 'Guru',
                    ])
                    ->required(),

                Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true),

                TextInput::make('password')
                    ->password()
                    ->label('Password')
                    ->dehydrateStateUsing(fn($state) => filled($state) ? Hash::make($state) : null)
                    ->dehydrated(fn($state) => filled($state))
                    ->required(fn(string $operation) => $operation === 'create'),
            ]);
    }
}
