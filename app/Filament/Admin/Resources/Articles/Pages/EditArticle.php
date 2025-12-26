<?php

namespace App\Filament\Admin\Resources\Articles\Pages;

use Filament\Actions\DeleteAction;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Admin\Resources\Articles\ArticleResource;

class EditArticle extends EditRecord
{
    protected static string $resource = ArticleResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['admin_id'] = Auth::id();
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        return $data;
    }


    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
