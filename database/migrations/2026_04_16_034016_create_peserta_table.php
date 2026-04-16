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
        Schema::create('peserta', function (Blueprint $table) {
            $table->id('id_peserta');
            $table->string('nama', 60);
            $table->string('sekolah', 50);
            $table->string('bidang_jurusan', 15);
            $table->smallInteger('nisn');
            $table->smallInteger('semester');
            $table->date('awal_magang');
            $table->date('akhir_magang');
            $table->string('no_telp', 20);
            $table->text('alamat');
            $table->smallInteger('kelas');
            $table->string('password', 60);
            $table->string('email', 60);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta');
    }
};
