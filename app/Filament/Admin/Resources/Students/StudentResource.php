<?php

namespace App\Filament\Admin\Resources\Students;

use BackedEnum;
use UnitEnum;
use App\Models\Student;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;
use App\Filament\Admin\Resources\Students\Pages\EditStudent;
use App\Filament\Admin\Resources\Students\Pages\ListStudents;
use App\Filament\Admin\Resources\Students\Pages\CreateStudent;
use App\Filament\Admin\Resources\Students\Schemas\StudentForm;
use App\Filament\Admin\Resources\Students\Tables\StudentsTable;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::UserGroup;

    protected static ?string $navigationLabel = 'Siswa & Alumni';
    protected static ?string $label = 'Siswa & Alumni';
    protected static ?string $pluralLabel = 'Siswa & Alumni';
    protected static string|UnitEnum|null $navigationGroup = 'Manajemen Siswa';
    protected static ?int $navigationSort = 20;


    public static function canAccess(): bool
    {
        return in_array(Auth::user()?->role, ['super_admin', 'staff'], true);
    }

    public static function form(Schema $schema): Schema
    {
        return StudentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StudentsTable::configure($table);
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
            'index' => ListStudents::route('/'),
            'create' => CreateStudent::route('/create'),
            'edit' => EditStudent::route('/{record}/edit'),
        ];
    }
}
