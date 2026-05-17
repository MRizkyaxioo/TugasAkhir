<?php

namespace App\Console\Commands;

use App\Models\Presensi;
use App\Models\PresensiPeserta;
use App\Models\Peserta;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PresensiScheduler extends Command
{
    protected $signature = 'presensi:jadwal';
    protected $description = 'Buka/tutup presensi otomatis sesuai jadwal, dan buat jadwal besok jika belum ada';

    public function handle()
    {
        $now = Carbon::now();
        $today = $now->toDateString();
        $timeNow = $now->format('H:i');

        // --- BUKA OTOMATIS ---
        $presensiBuka = Presensi::where('tanggal', $today)
            ->where('is_open', 0)
            ->where('jam_buka', '<=', $timeNow)
            ->first();

        if ($presensiBuka) {
            $presensiBuka->update([
                'is_open' => 1,
                'opened_at' => $now,
            ]);

            $pesertaAktif = Peserta::whereHas('hasilPendaftaran', function ($q) {
                $q->where('status', 'diterima');
            })->pluck('id_peserta');

            foreach ($pesertaAktif as $idPeserta) {
                PresensiPeserta::firstOrCreate(
                    [
                        'id_presensi' => $presensiBuka->id_presensi,
                        'id_peserta'   => $idPeserta,
                    ],
                    [
                        'status_kehadiran' => 'alpa',
                        'tanggal_presensi' => null,
                        'is_final'         => 0,
                    ]
                );
            }

            $this->info("Presensi {$today} dibuka otomatis.");
        }

        // --- TUTUP OTOMATIS ---
        $presensiTutup = Presensi::where('tanggal', $today)
            ->where('is_open', 1)
            ->where('jam_tutup', '<=', $timeNow)
            ->first();

        if ($presensiTutup) {
            $presensiTutup->update([
                'is_open' => 0,
                'closed_at' => $now,
            ]);

            PresensiPeserta::where('id_presensi', $presensiTutup->id_presensi)
                ->where('is_final', 0)
                ->update(['is_final' => 1]);

            $this->info("Presensi {$today} ditutup otomatis & data difinalisasi.");
        }

        // --- OTOMATIS BUAT JADWAL UNTUK BESOK JIKA BELUM ADA ---
        $tomorrow = Carbon::tomorrow()->toDateString();
        if (!Presensi::where('tanggal', $tomorrow)->exists()) {
            $lastPresensi = Presensi::orderBy('tanggal', 'desc')->first();
            if ($lastPresensi) {
                Presensi::create([
                    'tanggal'   => $tomorrow,
                    'jam_buka'  => $lastPresensi->jam_buka,
                    'jam_tutup' => $lastPresensi->jam_tutup,
                    'is_open'   => 0,
                ]);
                $this->info("Jadwal presensi untuk besok ({$tomorrow}) dibuat otomatis.");
            }
        }
    }
}
