<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penilaian_peserta', function (Blueprint $table) {
            $table->id('id_penilaian_peserta');

            $table->foreignId('id_peserta')
                ->constrained('peserta', 'id_peserta')
                ->cascadeOnDelete();

            $table->foreignId('id_kriteria_nilai')
                ->constrained('kriteria_nilai', 'id_kriteria_nilai')
                ->cascadeOnDelete();

            $table->smallInteger('nilai');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_peserta');
    }
};
