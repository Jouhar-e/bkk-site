<?php

namespace App\Filament\Admin\Resources\StudentOutcomes;

use BackedEnum;
use UnitEnum;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use App\Models\StudentOutcome;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;
use App\Filament\Admin\Resources\StudentOutcomes\Pages\EditStudentOutcome;
use App\Filament\Admin\Resources\StudentOutcomes\Pages\ListStudentOutcomes;
use App\Filament\Admin\Resources\StudentOutcomes\Pages\CreateStudentOutcome;
use App\Filament\Admin\Resources\StudentOutcomes\Schemas\StudentOutcomeForm;
use App\Filament\Admin\Resources\StudentOutcomes\Tables\StudentOutcomesTable;

class StudentOutcomeResource extends Resource
{
    protected static ?string $model = StudentOutcome::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ChartBar;

    protected static ?string $navigationLabel = 'Outcome Siswa';
    protected static ?string $label = 'Outcome Siswa';
    protected static ?string $pluralLabel = 'Outcome Siswa';
    protected static string|UnitEnum|null $navigationGroup = 'Manajemen Siswa';
    protected static ?int $navigationSort = 21;

    public static function canAccess(): bool
    {
        return in_array(Auth::user()?->role, ['super_admin', 'staff'], true);
    }

    public static function form(Schema $schema): Schema
    {
        return StudentOutcomeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StudentOutcomesTable::configure($table);
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
            'index' => ListStudentOutcomes::route('/'),
            'create' => CreateStudentOutcome::route('/create'),
            'edit' => EditStudentOutcome::route('/{record}/edit'),
        ];
    }
}
