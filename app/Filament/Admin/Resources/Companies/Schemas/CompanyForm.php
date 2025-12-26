<?php

namespace App\Filament\Admin\Resources\Companies\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;

class CompanyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Perusahaan')
                    ->required()
                    ->maxLength(255),

                TextInput::make('sector')
                    ->label('Bidang Usaha')
                    ->maxLength(255),

                TextInput::make('city')
                    ->label('Kota')
                    ->maxLength(255),

                TextInput::make('website')
                    ->label('Website')
                    ->url()
                    ->maxLength(255),

                TextInput::make('contact_person')
                    ->label('Contact Person')
                    ->maxLength(255),

                TextInput::make('phone')
                    ->label('No. Telepon')
                    ->tel()
                    ->maxLength(20),

                Toggle::make('is_partner')
                    ->label('Partner BKK')
                    ->default(false),
            ]);
    }
}
