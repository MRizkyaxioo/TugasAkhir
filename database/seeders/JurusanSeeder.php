<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JurusanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('jurusan')->insert([
            ['jurusan' => 'Rekayasa Perangkat Lunak'],
            ['jurusan' => 'Teknik Komputer dan Jaringan'],
            ['jurusan' => 'Multimedia'],
            ['jurusan' => 'Desain Komunikasi Visual'],
            ['jurusan' => 'Animasi'],
            ['jurusan' => 'Akuntansi dan Keuangan Lembaga'],
            ['jurusan' => 'Manajemen Perkantoran'],
            ['jurusan' => 'Bisnis Daring dan Pemasaran'],
            ['jurusan' => 'Perhotelan'],
            ['jurusan' => 'Usaha Layanan Pariwisata'],
            ['jurusan' => 'Teknik Kendaraan Ringan'],
            ['jurusan' => 'Teknik Sepeda Motor'],
            ['jurusan' => 'Teknik Instalasi Tenaga Listrik'],
            ['jurusan' => 'Teknik Audio Video'],
            ['jurusan' => 'Teknik Pemesinan'],
            ['jurusan' => 'Teknik Pengelasan'],
            ['jurusan' => 'Teknik Pendingin dan Tata Udara'],
            ['jurusan' => 'Kimia Industri'],
            ['jurusan' => 'Farmasi'],
            ['jurusan' => 'Keperawatan'],
            ['jurusan' => 'Teknik Informatika'],
            ['jurusan' => 'Sistem Informasi'],
            ['jurusan' => 'Teknik Sipil'],
            ['jurusan' => 'Teknik Mesin'],
            ['jurusan' => 'Teknik Elektro'],
            ['jurusan' => 'Arsitektur'],
            ['jurusan' => 'Akuntansi'],
            ['jurusan' => 'Manajemen'],
            ['jurusan' => 'Administrasi Bisnis'],
            ['jurusan' => 'Hukum'],
            ['jurusan' => 'Ilmu Komunikasi'],
            ['jurusan' => 'Pendidikan Matematika'],
            ['jurusan' => 'Pendidikan Bahasa Inggris'],
            ['jurusan' => 'Pendidikan Guru Sekolah Dasar'],
            ['jurusan' => 'Agribisnis'],
            ['jurusan' => 'Agroteknologi'],
            ['jurusan' => 'Peternakan'],
            ['jurusan' => 'Perikanan'],
            ['jurusan' => 'Kesehatan Masyarakat'],
            ['jurusan' => 'Psikologi'],
            ['jurusan' => 'Ekonomi Syariah'],
            ['jurusan' => 'Pendidikan Agama Islam'],
        ]);
    }
}
