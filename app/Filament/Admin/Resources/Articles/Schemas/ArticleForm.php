<?php

namespace App\Filament\Admin\Resources\Articles\Schemas;

use Illuminate\Support\Str;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\DateTimePicker;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name')
                    ->required(),

                TextInput::make('title')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(
                        fn($state, callable $set) =>
                        $set('slug', Str::slug($state))
                    ),

                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),

                FileUpload::make('cover_image')
                    ->label('Gambar Cover')
                    ->image()
                    ->acceptedFileTypes([
                        'image/jpeg',
                        'image/png',
                        'image/webp',
                    ])
                    ->disk('public')
                    ->directory('articles')
                    ->visibility('public')
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        '16:9',
                    ])
                    ->maxSize(2048) // KB = 2MB
                    ->helperText('Rasio 16:9. Disarankan 1200×675 px. Maksimal 2MB.'),


                RichEditor::make('content')
                    ->required()
                    ->columnSpanFull(),

                Select::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                    ])
                    ->required(),

                DateTimePicker::make('published_at')
                    ->hidden()
                    ->dehydrated()

            ]);
    }
}
