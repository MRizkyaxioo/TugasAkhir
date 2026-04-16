<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared("
    CREATE TRIGGER after_update_status
    AFTER UPDATE ON hasil_pendaftaran
    FOR EACH ROW
    BEGIN
        -- Kurangi kuota
        IF NEW.status = 'diterima' AND OLD.status != 'diterima' THEN
            UPDATE kuota_magang
            SET kuota_peserta = GREATEST(kuota_peserta - 1, 0)
            WHERE id_kuota = 1;
        END IF;

        -- Kembalikan kuota
        IF OLD.status = 'diterima' AND NEW.status != 'diterima' THEN
            UPDATE kuota_magang
            SET kuota_peserta = kuota_peserta + 1
            WHERE id_kuota = 1;
        END IF;
    END
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("
            DROP TRIGGER IF EXISTS after_update_status
        ");
    }
};
