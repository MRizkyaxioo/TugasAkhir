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
        Schema::create('kuota_magang', function (Blueprint $table) {
            $table->id('id_kuota');
            $table->smallInteger('kuota_peserta');
            $table->timestamps();
        });

        DB::table('kuota_magang')->insert([
            'id_kuota' => 1,
            'kuota_peserta' => '1',
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kuota_magang');
    }
};
