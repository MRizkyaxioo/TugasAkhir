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
        Schema::create('pembimbing_lapangan', function (Blueprint $table) {
            $table->id('id_pembimbing');

            $table->foreignId('id_role')
                ->constrained('role_khusus', 'id_role')
                ->cascadeOnDelete();

            $table->string('nama', 60);
            $table->string('nip_nidn', 20)->nullable();
            $table->string('password', 60);
            $table->string('username', 60);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembimbing_lapangan');
    }
};
