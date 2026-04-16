<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared("
            CREATE TRIGGER after_insert_peserta
            AFTER INSERT ON peserta
            FOR EACH ROW
            BEGIN
                INSERT INTO hasil_pendaftaran (id_peserta, status)
                VALUES (NEW.id_peserta, 'pending');
            END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("
            DROP TRIGGER IF EXISTS after_insert_peserta
        ");
    }
};
