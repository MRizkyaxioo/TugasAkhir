<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('administrasi', function (Blueprint $table) {
            $table->id('id_administrasi');

            $table->foreignId('id_role')
                ->constrained('role_khusus', 'id_role')
                ->cascadeOnDelete();

            $table->string('username', 60);
            $table->string('password', 60);
            $table->timestamps();
        });

        DB::table('administrasi')->insert([
            'id_role' => 1, // admin
            'username' => 'perpustakaanpoliban',
            'password' => Hash::make('poliban456')
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administrasi');
    }
};
