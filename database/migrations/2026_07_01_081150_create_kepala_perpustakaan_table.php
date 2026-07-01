<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kepala_perpustakaan', function (Blueprint $table) {
            $table->id('id_kepala');
            $table->string('nama', 60);
            $table->timestamps();
        });

        // seed default 1 baris
        DB::table('kepala_perpustakaan')->insert([
            'nama'       => 'Asrani, S.I.Pust.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('kepala_perpustakaan');
    }
};
