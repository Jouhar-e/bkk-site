<?php

namespace App\Filament\Admin\Resources\ArticleCategories;

use App\Filament\Admin\Resources\ArticleCategories\Pages\CreateArticleCategory;
use App\Filament\Admin\Resources\ArticleCategories\Pages\EditArticleCategory;
use App\Filament\Admin\Resources\ArticleCategories\Pages\ListArticleCategories;
use App\Filament\Admin\Resources\ArticleCategories\Schemas\ArticleCategoryForm;
use App\Filament\Admin\Resources\ArticleCategories\Tables\ArticleCategoriesTable;
use App\Models\ArticleCategory;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class ArticleCategoryResource extends Resource
{
    protected static ?string $model = ArticleCategory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Tag;

    protected static ?string $navigationLabel = 'Kategori Artikel';
    protected static ?string $label = 'Kategori Artikel';
    protected static ?string $pluralLabel = 'Kategori Artikel';
    protected static string|UnitEnum|null $navigationGroup = 'Data Master';
    protected static ?int $navigationSort = 42;

    public static function canAccess(): bool
    {
        return Auth::user()?->role === 'super_admin';
    }

    public static function form(Schema $schema): Schema
    {
        return ArticleCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ArticleCategoriesTable::configure($table);
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
            'index' => ListArticleCategories::route('/'),
            'create' => CreateArticleCategory::route('/create'),
            'edit' => EditArticleCategory::route('/{record}/edit'),
        ];
    }
}
