<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SekolahKampusSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('sekolah_kampus')->insert([

            /*
            |--------------------------------------------------------------------------
            | SMK Kota Banjarmasin
            |--------------------------------------------------------------------------
            */
            ['nama_sekolah_kampus' => 'SMKN 1 Banjarmasin'],
            ['nama_sekolah_kampus' => 'SMKN 2 Banjarmasin'],
            ['nama_sekolah_kampus' => 'SMKN 3 Banjarmasin'],
            ['nama_sekolah_kampus' => 'SMKN 4 Banjarmasin'],
            ['nama_sekolah_kampus' => 'SMKN 5 Banjarmasin'],

            /*
            |--------------------------------------------------------------------------
            | SMK Kabupaten Banjar
            |--------------------------------------------------------------------------
            */
            ['nama_sekolah_kampus' => 'SMKN 1 Martapura'],
            ['nama_sekolah_kampus' => 'SMKN 2 Martapura'],
            ['nama_sekolah_kampus' => 'SMKN 1 Karang Intan'],
            ['nama_sekolah_kampus' => 'SMKN 1 Sungai Pinang'],
            ['nama_sekolah_kampus' => 'SMKN 1 Gambut'],
            ['nama_sekolah_kampus' => 'SMKN 1 Aluh-Aluh'],

            // ===========================
// KABUPATEN BANJAR - SMK SWASTA
// ===========================
['nama_sekolah_kampus' => 'SMK Darussalam Martapura'],
['nama_sekolah_kampus' => 'SMK Gema Kalimantan'],
['nama_sekolah_kampus' => 'SMK Muhammadiyah Martapura'],
['nama_sekolah_kampus' => 'SMK PGRI Martapura'],
['nama_sekolah_kampus' => 'SMK Karya Budi'],
['nama_sekolah_kampus' => 'SMK Al Amin Martapura'],


            /*
            |--------------------------------------------------------------------------
            | SMK Kota Banjarbaru
            |--------------------------------------------------------------------------
            */
            ['nama_sekolah_kampus' => 'SMKN 1 Banjarbaru'],
            ['nama_sekolah_kampus' => 'SMKN 2 Banjarbaru'],
            ['nama_sekolah_kampus' => 'SMKN 3 Banjarbaru'],

            /*
            |--------------------------------------------------------------------------
            | SMK Kabupaten Barito Kuala
            |--------------------------------------------------------------------------
            */
            ['nama_sekolah_kampus' => 'SMKN 1 Marabahan'],
            ['nama_sekolah_kampus' => 'SMKN 1 Alalak'],
            ['nama_sekolah_kampus' => 'SMKN 1 Cerbon'],
            ['nama_sekolah_kampus' => 'SMKN 1 Bakumpai'],

            // ===========================
// KABUPATEN BARITO KUALA - SMK SWASTA
// ===========================
['nama_sekolah_kampus' => 'SMK Ma Arif NU Tabunganen'],
['nama_sekolah_kampus' => 'SMK Islam Alalak'],
['nama_sekolah_kampus' => 'SMK PGRI Marabahan'],
['nama_sekolah_kampus' => 'SMK Muhammadiyah Marabahan'],

            /*
            |--------------------------------------------------------------------------
            | Perguruan Tinggi
            |--------------------------------------------------------------------------
            */
            ['nama_sekolah_kampus' => 'Universitas Lambung Mangkurat'],
            ['nama_sekolah_kampus' => 'Universitas Islam Kalimantan Muhammad Arsyad Al Banjari'],
            ['nama_sekolah_kampus' => 'Universitas Achmad Yani Banjarmasin'],
            ['nama_sekolah_kampus' => 'Universitas Nahdlatul Ulama Kalimantan Selatan'],
            ['nama_sekolah_kampus' => 'Universitas Muhammadiyah Banjarmasin'],
            ['nama_sekolah_kampus' => 'STIKES Suaka Insan Banjarmasin'],
            ['nama_sekolah_kampus' => 'STIKES Husada Borneo'],
            ['nama_sekolah_kampus' => 'Politeknik Hasnur'],
            ['nama_sekolah_kampus' => 'Politeknik Unggulan Kalimantan'],
            ['nama_sekolah_kampus' => 'Sekolah Tinggi Ilmu Ekonomi Indonesia Banjarmasin'],
            ['nama_sekolah_kampus' => 'Sekolah Tinggi Ilmu Administrasi Bina Banua'],
            ['nama_sekolah_kampus' => 'Universitas Sari Mulia'],
        ]);
    }
}
