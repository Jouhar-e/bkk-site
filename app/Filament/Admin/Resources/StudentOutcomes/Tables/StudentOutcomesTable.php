<?php

namespace App\Filament\Admin\Resources\StudentOutcomes\Tables;

use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Illuminate\Support\Facades\Auth;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;

class StudentOutcomesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student.nisn')
                    ->label('NISN')
                    ->searchable(),

                TextColumn::make('student.name')
                    ->label('Nama')
                    ->searchable(),

                TextColumn::make('student.major.name')
                    ->label('Jurusan'),

                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'primary' => 'belum_tersalurkan',
                        'success' => 'bekerja',
                        'info' => 'kuliah',
                        'warning' => 'wirausaha',
                    ]),

                IconColumn::make('is_verified')
                    ->label('Verified')
                    ->boolean(),

                TextColumn::make('updated_at')
                    ->label('Update')
                    ->dateTime('d M Y'),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'bekerja' => 'Bekerja',
                        'kuliah' => 'Kuliah',
                        'wirausaha' => 'Wirausaha',
                        'belum_tersalurkan' => 'Belum Tersalurkan',
                    ]),

                SelectFilter::make('is_verified')
                    ->options([
                        1 => 'Verified',
                        0 => 'Belum Verified',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('verify')
                    ->label('Verifikasi')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn($record) => ! $record->is_verified)
                    ->action(function ($record) {
                        $record->update([
                            'is_verified' => true,
                            'updated_by_type' => 'admin',
                            'updated_by_id' => Auth::id(),
                            'last_updated_at' => now(),
                        ]);
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('updated_at', 'desc');
    }
}
