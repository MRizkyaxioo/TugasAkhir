<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('administrasi')->insert([
            'id_role' => 1, // admin
            'username' => 'perpustakaanpoliban',
            'password' => Hash::make('poliban456')
        ]);
    }
}
