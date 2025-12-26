<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Major;

class MajorSeeder extends Seeder
{
    public function run(): void
    {
        $majors = [
            ['code' => 'RPL', 'name' => 'Rekayasa Perangkat Lunak'],
            ['code' => 'TPM', 'name' => 'Teknik Pemesinan'],
            ['code' => 'TKR', 'name' => 'Teknik Kendaraan Ringan'],
        ];

        foreach ($majors as $major) {
            Major::updateOrCreate(
                ['code' => $major['code']],
                ['name' => $major['name']]
            );
        }
    }
}
