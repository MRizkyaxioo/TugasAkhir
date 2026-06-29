<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SekolahKampusSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('sekolah_kampus')->insert([
            ['nama_sekolah_kampus' => 'SMKN 1 Banjarmasin'],
            ['nama_sekolah_kampus' => 'SMKN 2 Banjarmasin'],
            ['nama_sekolah_kampus' => 'SMKN 3 Banjarmasin'],
            ['nama_sekolah_kampus' => 'SMKN 4 Banjarmasin'],
            ['nama_sekolah_kampus' => 'SMKN 5 Banjarmasin'],

            ['nama_sekolah_kampus' => 'SMK Wikrama 1 Banjarmasin'],
            ['nama_sekolah_kampus' => 'SMK Muhammadiyah 1 Banjarmasin'],
            ['nama_sekolah_kampus' => 'SMK Muhammadiyah 2 Banjarmasin'],
            ['nama_sekolah_kampus' => 'SMK Muhammadiyah 3 Banjarmasin'],
            ['nama_sekolah_kampus' => 'SMK Bina Banua Banjarmasin'],
            ['nama_sekolah_kampus' => 'SMK ISFI Banjarmasin'],
            ['nama_sekolah_kampus' => 'SMK Syuhada Banjarmasin'],

            ['nama_sekolah_kampus' => 'Universitas Lambung Mangkurat'],
            ['nama_sekolah_kampus' => 'Universitas Islam Kalimantan Muhammad Arsyad Al-Banjari'],
            ['nama_sekolah_kampus' => 'Universitas Muhammadiyah Banjarmasin'],
            ['nama_sekolah_kampus' => 'UIN Antasari Banjarmasin'],
            ['nama_sekolah_kampus' => 'Universitas Achmad Yani Banjarmasin'],
            ['nama_sekolah_kampus' => 'STIE Nasional Banjarmasin'],
        ]);
    }
}
