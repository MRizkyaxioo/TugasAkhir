<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('role_khusus', function (Blueprint $table) {
            $table->id('id_role');
            $table->string('role', 25);
            $table->timestamps();
        });

        DB::table('role_khusus')->insert([
            [
                'id_role' => 1,
                'role' => 'admin'
            ],
            [
                'id_role' => 2,
                'role' => 'pembimbing'
            ],
            [
                'id_role' => 3,
                'role' => 'pembimbing_sekolah_kampus'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_khusus');
    }
};
