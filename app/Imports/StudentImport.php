<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\Major;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Validasi minimal
        if (
            empty($row['nisn']) ||
            empty($row['name']) ||
            empty($row['major_code'])
        ) {
            return null; // skip baris
        }

        $major = Major::where('code', $row['major_code'])->first();

        if (! $major) {
            return null; // skip jika jurusan tidak valid
        }

        return new Student([
            'nisn' => $row['nisn'],
            'name' => $row['name'],
            'email' => $row['email'] ?? null,
            'password' => Hash::make(
                $row['password'] ?? 'password123'
            ),
            'level' => $row['level'] ?? 'siswa',
            'major_id' => $major->id,
            'graduation_year' => $row['graduation_year'] ?? null,
            'phone' => $row['phone'] ?? null,
            'is_active' => 1,
            'must_change_password' => 1,
        ]);
    }
}
