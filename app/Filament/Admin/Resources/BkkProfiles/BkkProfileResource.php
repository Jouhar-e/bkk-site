<?php

namespace App\Filament\Admin\Resources\BkkProfiles;

use BackedEnum;
use UnitEnum;
use App\Models\BkkProfile;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;
use App\Filament\Admin\Resources\BkkProfiles\Pages\EditBkkProfile;
use App\Filament\Admin\Resources\BkkProfiles\Pages\ListBkkProfiles;
use App\Filament\Admin\Resources\BkkProfiles\Pages\CreateBkkProfile;
use App\Filament\Admin\Resources\BkkProfiles\Schemas\BkkProfileForm;
use App\Filament\Admin\Resources\BkkProfiles\Tables\BkkProfilesTable;

class BkkProfileResource extends Resource
{
    protected static ?string $model = BkkProfile::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::BuildingOffice2;

    protected static ?string $navigationLabel = 'Profil BKK';
    protected static ?string $label = 'Profil BKK';
    protected static ?string $pluralLabel = 'Profil BKK';
    protected static string|UnitEnum|null $navigationGroup = 'Konten & Informasi';
    protected static ?int $navigationSort = 11;

    public static function canAccess(): bool
    {
        return Auth::user()?->role === 'super_admin';
    }

    public static function canCreate(): bool
    {
        return BkkProfile::count() === 0;
    }

    public static function form(Schema $schema): Schema
    {
        return BkkProfileForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BkkProfilesTable::configure($table);
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
            'index' => ListBkkProfiles::route('/'),
            'create' => CreateBkkProfile::route('/create'),
            'edit' => EditBkkProfile::route('/{record}/edit'),
        ];
    }
}
