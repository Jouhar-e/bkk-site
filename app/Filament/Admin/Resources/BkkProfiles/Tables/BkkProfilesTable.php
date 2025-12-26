<?php

namespace App\Filament\Admin\Resources\BkkProfiles\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class BkkProfilesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
               ImageColumn::make('logo')
                ->label('Logo')
                ->disk('public')
                ->height(40),

            TextColumn::make('name_bkk')
                ->label('Nama BKK')
                ->searchable(),

            TextColumn::make('school_name')
                ->label('Sekolah'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
