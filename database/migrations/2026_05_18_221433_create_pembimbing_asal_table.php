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
        Schema::create('pembimbing_asal', function (Blueprint $table) {
            $table->id('id_pembimbing_asal');
            $table->foreignId('id_role')
                ->constrained('role_khusus', 'id_role')
                ->cascadeOnDelete();
            $table->string('nama', 60);
            $table->string('password', 60);
            $table->string('username', 60);
            $table->foreignId('id_sekolah_kampus')
                ->constrained('sekolah_kampus', 'id_sekolah_kampus')
                ->cascadeOnDelete();
            $table->string('no_telp', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembimbing_sekolah_kampus');
    }
};
