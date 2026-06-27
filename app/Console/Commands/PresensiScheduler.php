<?php

namespace App\Console\Commands;

use App\Models\HariLibur;
use App\Models\Peserta;
use App\Models\Presensi;
use App\Models\PresensiPeserta;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class PresensiScheduler extends Command
{
    protected $signature = 'presensi:jadwal';

    protected $description = 'Scheduler buka, tutup, dan membuat jadwal presensi otomatis';

    public function handle()
    {
        $this->bukaPresensi();

        $this->tutupPresensi();

        $this->buatJadwalBesok();

        return Command::SUCCESS;
    }

    /**
     * ===============================
     * BUKA PRESENSI OTOMATIS
     * ===============================
     */
    private function bukaPresensi()
    {
        $today = Carbon::today()->toDateString();

        // Hari libur tidak membuka presensi
        if (HariLibur::where('tanggal', $today)->exists()) {
            $this->info("Hari ini ({$today}) hari libur. Presensi tidak dibuka.");
            return;
        }

        $timeNow = Carbon::now()->format('H:i');

        $presensi = Presensi::whereDate('tanggal', $today)
            ->where('status', 'belum_dibuka')
            ->where('jam_buka', '<=', $timeNow)
            ->first();

        if (!$presensi) {
            return;
        }

        DB::transaction(function () use ($presensi) {

            $presensi->update([
                'status' => 'dibuka'
            ]);

            $pesertaAktif = Peserta::whereHas('hasilPendaftaran', function ($q) {
                $q->where('status', 'diterima');
            })->pluck('id_peserta');

            foreach ($pesertaAktif as $idPeserta) {

                PresensiPeserta::firstOrCreate(
                    [
                        'id_presensi' => $presensi->id_presensi,
                        'id_peserta' => $idPeserta,
                    ],
                    [
                        'status_kehadiran' => 'alpa',
                        'tanggal_presensi' => null,
                        'is_final' => false,
                    ]
                );
            }
        });

        $this->info("Presensi {$today} berhasil dibuka.");
    }

    /**
     * ===============================
     * TUTUP PRESENSI OTOMATIS
     * ===============================
     */
    private function tutupPresensi()
    {
        $today = Carbon::today()->toDateString();

        // Hari libur tidak ada proses
        if (HariLibur::where('tanggal', $today)->exists()) {
            return;
        }

        $timeNow = Carbon::now()->format('H:i');

        $presensi = Presensi::whereDate('tanggal', $today)
            ->where('status', 'dibuka')
            ->where('jam_tutup', '<=', $timeNow)
            ->first();

        if (!$presensi) {
            return;
        }

        DB::transaction(function () use ($presensi) {

            $presensi->update([
                'status' => 'ditutup'
            ]);

            PresensiPeserta::where('id_presensi', $presensi->id_presensi)
                ->where('is_final', false)
                ->update([
                    'is_final' => true
                ]);
        });

        $this->info("Presensi {$today} ditutup.");
    }

    /**
     * ===============================
     * MEMBUAT JADWAL BESOK
     * ===============================
     */
    private function buatJadwalBesok()
    {
        $tomorrow = Carbon::tomorrow()->toDateString();

        // Besok hari libur
        if (HariLibur::where('tanggal', $tomorrow)->exists()) {

            $this->info("Besok ({$tomorrow}) hari libur. Jadwal tidak dibuat.");

            return;
        }

        // Sudah ada jadwal
        if (Presensi::whereDate('tanggal', $tomorrow)->exists()) {
            return;
        }

        // Ambil jadwal terakhir
        $lastPresensi = Presensi::whereDate('tanggal', '<', $tomorrow)
            ->latest('tanggal')
            ->first();

        if (!$lastPresensi) {
            return;
        }

        Presensi::create([
            'tanggal' => $tomorrow,
            'jam_buka' => $lastPresensi->jam_buka,
            'jam_tutup' => $lastPresensi->jam_tutup,
            'status' => 'belum_dibuka',
        ]);

        $this->info("Jadwal presensi {$tomorrow} berhasil dibuat.");
    }
}
