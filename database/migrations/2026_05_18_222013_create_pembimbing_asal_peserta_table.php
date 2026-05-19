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
        Schema::create('pembimbing_asal_peserta', function (Blueprint $table) {
            $table->id('id_pembimbing_asal_peserta');

            $table->foreignId('id_peserta')
                ->constrained('peserta', 'id_peserta')
                ->cascadeOnDelete();

            $table->foreignId('id_pembimbing_asal')
                ->constrained('pembimbing_asal', 'id_pembimbing_asal')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembimbing_sekolah_kampus_peserta');
    }
};
