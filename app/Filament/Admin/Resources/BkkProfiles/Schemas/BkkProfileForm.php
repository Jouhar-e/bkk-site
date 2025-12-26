<?php

namespace App\Filament\Admin\Resources\BkkProfiles\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;

class BkkProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                 Section::make('Identitas BKK')
                ->schema([
                    TextInput::make('name_bkk')
                        ->label('Nama BKK')
                        ->required(),

                    TextInput::make('school_name')
                        ->label('Nama Sekolah')
                        ->required(),

                    FileUpload::make('logo')
                        ->label('Logo BKK')
                        ->disk('public')
                        ->directory('bkk')
                        ->image()
                        ->imageEditor()
                        ->helperText('Format PNG/JPG, transparan disarankan'),
                ])
                ->columns(2),

            /* =========================
             * DESKRIPSI
             * ========================= */
            Section::make('Informasi Umum')
                ->schema([
                    Textarea::make('description')
                        ->label('Deskripsi')
                        ->rows(3),

                    Textarea::make('vision')
                        ->label('Visi')
                        ->rows(3),

                    Textarea::make('mission')
                        ->label('Misi')
                        ->rows(3),
                ]),

            /* =========================
             * KONTAK & LOKASI
             * ========================= */
            Section::make('Kontak & Lokasi')
                ->schema([
                    TextInput::make('address')
                        ->label('Alamat'),

                    TextInput::make('city')
                        ->label('Kota'),

                    TextInput::make('phone')
                        ->label('Telepon'),

                    TextInput::make('email')
                        ->label('Email')
                        ->email(),

                    TextInput::make('office_hours')
                        ->label('Jam Operasional'),

                    TextInput::make('website')
                        ->label('Website')
                        ->url(),
                ])
                ->columns(2),

            /* =========================
             * SOSIAL MEDIA
             * ========================= */
            Section::make('Sosial Media')
                ->schema([
                    TextInput::make('facebook_url')
                        ->label('Facebook')
                        ->url(),

                    TextInput::make('instagram_url')
                        ->label('Instagram')
                        ->url(),

                    TextInput::make('linkedin_url')
                        ->label('LinkedIn')
                        ->url(),

                    TextInput::make('youtube_url')
                        ->label('YouTube')
                        ->url(),
                ])
                ->columns(2),
            ]);
    }
}
