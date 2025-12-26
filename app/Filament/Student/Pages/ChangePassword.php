<?php

namespace App\Filament\Student\Pages;

use BackedEnum;
use App\Models\Student;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\Placeholder;

class ChangePassword extends Page
{
    protected static null|string|BackedEnum $navigationIcon = null;
    protected static bool $shouldRegisterNavigation = false;
    protected string $view = 'filament.student.pages.change-password';

    public ?string $current_password = null;
    public ?string $password = null;
    public ?string $password_confirmation = null;

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('current_password')
                ->label('Password Lama')
                ->password()
                ->required()
                ->revealable(),

            TextInput::make('password')
                ->label('Password Baru')
                ->password()
                ->required()
                ->minLength(8)
                ->confirmed()
                ->revealable(),

            TextInput::make('password_confirmation')
                ->label('Konfirmasi Password Baru')
                ->password()
                ->required()
                ->revealable(),

            Placeholder::make('spacer')
                ->content('')
                ->hiddenLabel()
                ->columnSpanFull()
                ->extraAttributes(['class' => 'h-6']),
        ]);
    }

    public function save(): void
    {
        /** @var Student $student */
        $student = Auth::guard('student')->user();

        if (! Hash::check($this->current_password, $student->password)) {
            $this->addError('current_password', 'Password lama salah.');
            return;
        }

        $student->password = Hash::make($this->password);
        $student->must_change_password = false;
        $student->save();

        Notification::make()
            ->title('Berhasil')
            ->body('Password berhasil diperbarui.')
            ->success()
            ->send();

        $this->redirect('/student');
    }
}
