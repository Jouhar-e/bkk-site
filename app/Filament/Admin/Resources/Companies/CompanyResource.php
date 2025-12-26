<?php

namespace App\Filament\Admin\Resources\Companies;

use App\Filament\Admin\Resources\Companies\Pages\CreateCompany;
use App\Filament\Admin\Resources\Companies\Pages\EditCompany;
use App\Filament\Admin\Resources\Companies\Pages\ListCompanies;
use App\Filament\Admin\Resources\Companies\Schemas\CompanyForm;
use App\Filament\Admin\Resources\Companies\Tables\CompaniesTable;
use App\Models\Company;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use UnitEnum;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::BuildingOffice;

    protected static ?string $navigationLabel = 'Perusahaan';
    protected static ?string $label = 'Perusahaan';
    protected static ?string $pluralLabel = 'Perusahaan';
    protected static string|UnitEnum|null $navigationGroup = 'Data Master';
    protected static ?int $navigationSort = 40;


    public static function canAccess(): bool
    {
        return in_array(Auth::user()?->role, ['super_admin', 'staff'], true);
    }

    public static function form(Schema $schema): Schema
    {
        return CompanyForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CompaniesTable::configure($table);
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
            'index' => ListCompanies::route('/'),
            'create' => CreateCompany::route('/create'),
            'edit' => EditCompany::route('/{record}/edit'),
        ];
    }
}
