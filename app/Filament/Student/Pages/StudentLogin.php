<?php

namespace App\Filament\Student\Pages;

use Filament\Auth\Pages\Login as PagesLogin;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Validation\ValidationException;

class StudentLogin extends PagesLogin
{
    /**
     * Override form login
     */
    public function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('nisn')
                ->label('NISN')
                ->required()
                ->autofocus(),

            $this->getPasswordFormComponent(),
            $this->getRememberFormComponent(),
        ]);
    }

    /**
     * Mapping credential untuk auth
     */
    protected function getCredentialsFromFormData(array $data): array
    {
        return [
            'nisn' => $data['nisn'],
            'password' => $data['password'],
        ];
    }

    /**
     * ✅ INI CARA RESMI FILAMENT 4
     * Dipanggil otomatis saat login gagal
     */
    protected function throwFailureValidationException(): never
    {
        throw ValidationException::withMessages([
            'data.nisn' => 'NISN atau password tidak valid.',
        ]);
    }
}
