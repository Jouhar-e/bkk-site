<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@bkk.test'],
            [
                'name' => 'Super Admin BKK',
                'password' => Hash::make('admin123'), // ganti di production
                'role' => 'super_admin',
                'is_active' => true,
            ]
        );
    }
}
