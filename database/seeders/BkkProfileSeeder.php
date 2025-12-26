<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BkkProfile;

class BkkProfileSeeder extends Seeder
{
    public function run(): void
    {
        BkkProfile::updateOrCreate(
            ['school_name' => 'SMK Negeri Contoh'],
            [
                'name_bkk'     => 'Bursa Kerja Khusus SMK Negeri Contoh',

                // logo BKK (path relatif ke storage/public)
                'logo'         => 'bkk/logo.png',

                'description'  => 'Bursa Kerja Khusus (BKK) merupakan lembaga yang dibentuk oleh sekolah menengah kejuruan (SMK) untuk memfasilitasi penyaluran dan penempatan tenaga kerja lulusan SMK di dunia usaha dan dunia industri. Sebagai unit pelaksana yang bekerjasama dengan Dinas Tenaga Kerja dan Transmigrasi, BKK berperan memberikan informasi pasar kerja, pendaftaran pencari kerja, penyuluhan serta bimbingan jabatan, pelatihan keterampilan tambahan, dan penyaluran alumni ke perusahaan mitra.
                Melalui portal ini, kami menghubungkan lulusan SMK yang kompeten dan siap kerja dengan lowongan pekerjaan yang sesuai. Kami juga terus menjalin kerjasama dengan berbagai industri untuk memastikan alumni kami terserap secara optimal di pasar kerja nasional maupun internasional.
                BKK [Nama Sekolah] berkomitmen mendukung pengurangan pengangguran terbuka melalui penempatan yang tepat, serta meningkatkan kualitas SDM lulusan SMK sesuai tuntutan era global.
                Anda bisa ganti [Nama Sekolah] dengan nama sekolah Anda (misalnya: SMK Negeri Contoh). Jika ingin ditambahkan visi/misi atau elemen spesifik sekolah Anda, beri tahu saya agar saya sesuaikan lebih lanjut!',
                'vision'       => 'Membantu lulusan terserap di dunia kerja, kuliah, atau wirausaha.',
                'mission'      => 'Menghubungkan lulusan dengan DU/DI dan perguruan tinggi.',
                'address'      => 'Jl. Pendidikan No. 123',
                'city'         => 'Kota Contoh',
                'phone'        => '08123456789',
                'email'        => 'bkk@smkncontoh.sch.id',
                'office_hours' => 'Senin - Jumat, 08:00 - 15:00',
                'website'      => 'https://bkk.smkncontoh.sch.id',
                'facebook_url' => null,
                'instagram_url' => 'https://instagram.com/bkk_smkn_contoh',
                'linkedin_url' => null,
                'youtube_url'  => null,
            ]
        );
    }
}
