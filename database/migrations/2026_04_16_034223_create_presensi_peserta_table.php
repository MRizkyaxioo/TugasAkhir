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
        Schema::create('presensi_peserta', function (Blueprint $table) {
            $table->id('id_presensi_peserta');

            $table->foreignId('id_peserta')
                ->constrained('peserta', 'id_peserta')
                ->cascadeOnDelete();

            $table->foreignId('id_presensi')
                ->constrained('presensi', 'id_presensi')
                ->cascadeOnDelete();

            $table->string('surat_pendukung_izin', 255)->nullable();
            $table->dateTime('tanggal_presensi');
            $table->enum('status_kehadiran', ['hadir', 'izin', 'sakit', 'alpha']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensi_peserta');
    }
};
