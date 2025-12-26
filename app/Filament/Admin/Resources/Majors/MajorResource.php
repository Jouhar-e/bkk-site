<?php

namespace App\Filament\Admin\Resources\Majors;

use UnitEnum;
use BackedEnum;
use App\Models\Major;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;
use App\Filament\Admin\Resources\Majors\Pages\EditMajor;
use App\Filament\Admin\Resources\Majors\Pages\ListMajors;
use App\Filament\Admin\Resources\Majors\Pages\CreateMajor;
use App\Filament\Admin\Resources\Majors\Schemas\MajorForm;
use App\Filament\Admin\Resources\Majors\Tables\MajorsTable;

class MajorResource extends Resource
{
    protected static ?string $model = Major::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::AcademicCap;

    protected static ?string $navigationLabel = 'Jurusan';
    protected static ?string $label = 'Jurusan';
    protected static ?string $pluralLabel = 'Jurusan';
    protected static string|UnitEnum|null $navigationGroup = 'Data Master';
    protected static ?int $navigationSort = 41;

    public static function canAccess(): bool
    {
        return in_array(Auth::user()?->role, ['super_admin', 'staff'], true);
    }

    public static function form(Schema $schema): Schema
    {
        return MajorForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MajorsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMajors::route('/'),
            'create' => CreateMajor::route('/create'),
            'edit' => EditMajor::route('/{record}/edit'),
        ];
    }
}
