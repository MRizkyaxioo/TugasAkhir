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
        Schema::create('hasil_pendaftaran', function (Blueprint $table) {
            $table->id('id_hasil');

            $table->foreignId('id_peserta')
                ->constrained('peserta', 'id_peserta')
                ->cascadeOnDelete();

            $table->foreignId('id_berkas')
                ->constrained('berkas_magang', 'id_berkas')
                ->cascadeOnDelete();

            $table->enum('status', ['pending', 'diterima', 'ditolak', 'selesai']);
            $table->string('file_berkas_balasan', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_pendaftaran');
    }
};
