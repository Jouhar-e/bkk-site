<?php

namespace App\Filament\Admin\Resources\ArticleCategories\Schemas;

use Illuminate\Support\Str;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;

class ArticleCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                ->label('Nama Kategori')
                ->required()
                ->live(onBlur: true)
                ->afterStateUpdated(fn ($state, callable $set) =>
                    $set('slug', Str::slug($state))
                ),

            TextInput::make('slug')
                ->required()
                ->unique(ignoreRecord: true),
            ]);
    }
}
