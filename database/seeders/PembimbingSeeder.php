<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PembimbingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pembimbing_lapangan')->insert([
            'id_role' => 2, // pembimbing
            'nama' => 'Bayu',
            'nip_nidn' => 199501032025101001,
            'username' => 'pembimbing1',
            'password' => Hash::make('poliban123')
        ]);
    }
}
