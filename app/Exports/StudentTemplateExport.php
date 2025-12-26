<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentTemplateExport implements FromArray, WithHeadings
{
    public function headings(): array
    {
        return [
            'nisn',
            'name',
            'major_code',
            'level',
            'graduation_year',
            'email',
            'phone',
            'password',
        ];
    }

    public function array(): array
    {
        return [];
    }
}

