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
        Schema::create('logbook', function (Blueprint $table) {
            $table->id('id_logbook');

            $table->foreignId('id_peserta')
                ->constrained('peserta', 'id_peserta')
                ->cascadeOnDelete();

            $table->date('tanggal');
            $table->string('kegiatan', 60);
            $table->string('bukti_foto', 255);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logbook');
    }
};
