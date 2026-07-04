<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JurusanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('jurusan')->insert([
            // Bidang Perpustakaan
            ['jurusan' => 'Perpustakaan'],

            // Bidang Teknologi Informasi
            ['jurusan' => 'Teknik Informatika'],
            ['jurusan' => 'Manajemen Informatika'],
            ['jurusan' => 'Sistem Informasi'],
            ['jurusan' => 'Teknologi Informasi'],
            ['jurusan' => 'Rekayasa Perangkat Lunak'],
            ['jurusan' => 'Teknik Komputer dan Jaringan'],
            ['jurusan' => 'Multimedia'],
            ['jurusan' => 'Desain Komunikasi Visual'],

            // Bidang Administrasi
            ['jurusan' => 'Administrasi Perkantoran'],
            ['jurusan' => 'Otomatisasi dan Tata Kelola Perkantoran'],
            ['jurusan' => 'Manajemen Perkantoran'],
            ['jurusan' => 'Administrasi Bisnis'],

            // Bidang Bisnis
            ['jurusan' => 'Akuntansi'],
            ['jurusan' => 'Akuntansi dan Keuangan Lembaga'],
            ['jurusan' => 'Manajemen'],
            ['jurusan' => 'Bisnis Digital'],

            // Bidang Bahasa
            ['jurusan' => 'Bahasa Indonesia'],
            ['jurusan' => 'Sastra Indonesia'],
            ['jurusan' => 'Sastra Inggris'],
            ['jurusan' => 'Pendidikan Bahasa Indonesia'],
            ['jurusan' => 'Pendidikan Bahasa Inggris'],

            // Bidang Pendidikan
            ['jurusan' => 'Pendidikan Guru Sekolah Dasar'],
            ['jurusan' => 'Pendidikan Guru Pendidikan Anak Usia Dini'],

            // Bidang Komunikasi
            ['jurusan' => 'Ilmu Komunikasi'],
            ['jurusan' => 'Hubungan Masyarakat'],

            // Bidang Kearsipan
            ['jurusan' => 'Kearsipan'],

            // Bidang Umum
            ['jurusan' => 'Administrasi Publik'],
            ['jurusan' => 'Ilmu Pemerintahan'],
        ]);
    }
}
