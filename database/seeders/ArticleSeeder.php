<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\User;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@bkk.test')->first();
        $category = ArticleCategory::where('slug', 'lowongan-kerja')->first();

        if (! $admin || ! $category) {
            return;
        }

        Article::updateOrCreate(
            ['slug' => 'lowongan-operator-produksi-pt-teknologi-contoh'],
            [
                'admin_id'    => $admin->id,
                'category_id' => $category->id,
                'title'       => 'Lowongan Operator Produksi PT Teknologi Contoh',
                'content'     => 'Ini adalah contoh artikel lowongan kerja untuk portal BKK.',
                'cover_image' => null,
                'status'      => 'published',
                'published_at'=> now(),
            ]
        );
    }
}
