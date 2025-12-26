<?php

namespace App\Filament\Admin\Pages;

use BackedEnum;
use UnitEnum;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Placeholder;

class MyProfile extends Page
{
    protected static ?string $navigationLabel = 'Profil Saya';
    protected static ?string $title = 'Profil Saya';
    protected static null|BackedEnum|string $navigationIcon = Heroicon::UserCircle;
    protected static string|UnitEnum|null $navigationGroup = 'Akun Saya';
    protected static ?int $navigationSort = 50;

    protected string $view = 'filament.admin.pages.my-profile';

    public array $data = [];

    public function mount(): void
    {
        $user = Auth::user();

        $this->form->fill([
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->schema([
                Section::make('Informasi Akun')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama')
                            ->required(),

                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required(),
                    ]),

                Section::make('Ubah Password')
                    ->description('Kosongkan jika tidak ingin mengubah password.')
                    ->schema([
                        TextInput::make('password')
                            ->label('Password Baru')
                            ->password()
                            ->minLength(8)
                            ->dehydrateStateUsing(fn($state) => filled($state) ? Hash::make($state) : null)
                            ->dehydrated(fn($state) => filled($state)),

                        TextInput::make('password_confirmation')
                            ->label('Konfirmasi Password')
                            ->password()
                            ->same('password')
                            ->dehydrated(false),

                    ]),
                Placeholder::make('spacer')
                    ->content('')
                    ->hiddenLabel()
                    ->columnSpanFull()
                    ->extraAttributes(['class' => 'h-6']),
            ]);
    }

    public function save(): void
    {
        $user = Auth::user();

        $data = $this->form->getState();

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            ...(
                isset($data['password'])
                ? ['password' => $data['password']]
                : []
            ),
        ]);

        Notification::make()
            ->title('Profil berhasil diperbarui')
            ->success()
            ->send();
    }
}
