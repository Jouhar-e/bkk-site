<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Major;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $major = Major::where('code', 'RPL')->first();

        if (! $major) {
            // Kalau MajorSeeder belum jalan, jangan paksa insert
            return;
        }

        $graduationYear = 2025;
        $defaultPassword = $major->code . $graduationYear; // RPL2025

        Student::updateOrCreate(
            ['nisn' => '1234567890'],
            [
                'name'                => 'Siswa Contoh RPL',
                'email'               => 'siswa.rpl@contoh.test',
                'password'            => Hash::make($defaultPassword),
                'level'               => 'alumni', // atau 'siswa' kalau masih aktif
                'major_id'            => $major->id,
                'graduation_year'     => $graduationYear,
                'phone'               => '081300000000',
                'is_active'           => true,
                'must_change_password'=> true,
            ]
        );
    }
}
