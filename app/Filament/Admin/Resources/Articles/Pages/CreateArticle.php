<?php

namespace App\Filament\Admin\Resources\Articles\Pages;

use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Admin\Resources\Articles\ArticleResource;

class CreateArticle extends CreateRecord
{
    protected static string $resource = ArticleResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Tambahkan admin_id
        $data['admin_id'] = Auth::id();

        // Jika status published, set tanggal publish
        if (($data['status'] ?? 'draft') === 'published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        return $data;
    }
}
