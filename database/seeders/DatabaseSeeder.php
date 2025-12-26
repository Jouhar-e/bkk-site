<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            MajorSeeder::class,
            BkkProfileSeeder::class,
            CompanySeeder::class,
            StudentSeeder::class,
            ArticleCategorySeeder::class,
            ArticleSeeder::class,
        ]);
    }
}
