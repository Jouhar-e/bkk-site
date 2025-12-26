<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        Company::updateOrCreate(
            ['name' => 'PT Teknologi Contoh'],
            [
                'sector'      => 'Teknologi Informasi',
                'city'        => 'Jakarta',
                'is_partner'  => true,
                'website'     => 'https://pt-teknologi-contoh.test',
                'contact_person' => 'Budi',
                'phone'       => '081212345678',
            ]
        );

        Company::updateOrCreate(
            ['name' => 'CV Akuntansi Makmur'],
            [
                'sector'      => 'Akuntansi',
                'city'        => 'Bandung',
                'is_partner'  => true,
                'website'     => null,
                'contact_person' => 'Siti',
                'phone'       => '082233445566',
            ]
        );
    }
}
