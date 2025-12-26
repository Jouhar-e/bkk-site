<?php

namespace App\Filament\Student\Pages;

use BackedEnum;
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

    protected string $view = 'filament.student.pages.my-profile';

    public array $data = [];

    public function mount(): void
    {
        $student = Auth::guard('student')->user();

        $this->form->fill([
            // READ ONLY
            'nisn' => $student->nisn,
            'name' => $student->name,
            'major' => $student->major->name ?? '-',
            'graduation_year' => $student->graduation_year,
            'level' => ucfirst($student->level),

            // EDITABLE
            'email' => $student->email,
            'phone' => $student->phone,
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->schema([

                /* =====================
                 * DATA AKADEMIK (READ ONLY)
                 * ===================== */
                Section::make('Data Akademik')
                    ->schema([
                        TextInput::make('nisn')
                            ->label('NISN')
                            ->disabled(),

                        TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->disabled(),

                        TextInput::make('major')
                            ->label('Jurusan')
                            ->disabled(),

                        TextInput::make('graduation_year')
                            ->label('Tahun Lulus')
                            ->disabled(),

                        TextInput::make('level')
                            ->label('Status')
                            ->disabled()
                            ->helperText('Data Tidak Dapat Diubah.'),
                    ]),

                /* =====================
                 * DATA KONTAK
                 * ===================== */
                Section::make('Informasi Kontak')
                    ->schema([
                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required(),

                        TextInput::make('phone')
                            ->label('Nomor HP')
                            ->tel(),
                    ]),

                /* =====================
                 * PASSWORD
                 * ===================== */
                Section::make('Ubah Password')
                    ->description('Kosongkan jika tidak ingin mengubah password.')
                    ->schema([
                        TextInput::make('password')
                            ->label('Password Baru')
                            ->password()
                            ->minLength(8)
                            ->dehydrateStateUsing(
                                fn($state) => filled($state)
                                    ? Hash::make($state)
                                    : null
                            )
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
        $student = Auth::guard('student')->user();
        $data = $this->form->getState();

        $student->update([
            'email' => $data['email'],
            'phone' => $data['phone'],
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
