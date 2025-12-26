<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ArticleCategory;
use Illuminate\Support\Str;

class ArticleCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Lowongan Kerja',
            'Info Kuliah',
            'Seminar / Workshop',
            'Tips Karir',
        ];

        foreach ($categories as $name) {
            ArticleCategory::updateOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name]
            );
        }
    }
}
