<?php

namespace App\Filament\Admin\Resources\Students\Tables;

use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Illuminate\Support\Facades\Hash;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;

class StudentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nisn')->searchable(),
                TextColumn::make('name')->searchable(),
                TextColumn::make('major.name')->label('Jurusan'),
                BadgeColumn::make('level')
                    ->colors([
                        'primary' => 'siswa',
                        'success' => 'alumni',
                    ]),
                IconColumn::make('is_active')->boolean(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                self::resetPasswordAction(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    protected static function resetPasswordAction(): Action
    {
        return Action::make('resetPassword')
            ->label('Reset Password')
            ->icon('heroicon-o-key')
            ->color('danger')
            ->visible(fn() => Auth::user()?->role === 'super_admin')
            ->form([
                TextInput::make('password')
                    ->password()
                    ->required()
                    ->minLength(8)
                    ->revealable(),
                TextInput::make('password_confirmation')
                    ->password()
                    ->same('password')
                    ->required()
                    ->revealable(),
            ])
            ->action(function (Student $record, array $data) {
                $record->password = Hash::make($data['password']);
                $record->must_change_password = 1;
                $record->save();
            });
    }
}
