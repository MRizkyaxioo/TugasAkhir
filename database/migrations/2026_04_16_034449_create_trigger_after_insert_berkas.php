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
            CREATE TRIGGER after_insert_berkas
            AFTER INSERT ON berkas_magang
            FOR EACH ROW
            BEGIN
                UPDATE hasil_pendaftaran
                SET id_berkas = NEW.id_berkas
                WHERE id_peserta = NEW.id_peserta;
            END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("
            DROP TRIGGER IF EXISTS after_insert_berkas
        ");
    }
};
