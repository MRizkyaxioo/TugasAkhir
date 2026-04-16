<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleKhususSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('role_khusus')->insert([
            [
                'id_role' => 1,
                'role' => 'admin'
            ],
            [
                'id_role' => 2,
                'role' => 'pembimbing'
            ]
        ]);
    }
}
