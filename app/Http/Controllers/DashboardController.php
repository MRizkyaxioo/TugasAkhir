<?php

namespace App\Http\Controllers;

use App\Models\HasilPendaftaran;
use App\Models\KuotaMagang;
use App\Models\Peserta;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Kuota magang
        $kuota = KuotaMagang::find(1);

        // Peserta yang sedang magang
        $pesertaAktif = HasilPendaftaran::where('status', 'diterima')->count();

        // 5 alumni terbaru
        $alumni = Peserta::with([
                'jurusan',
                'sekolahKampus'
            ])
            ->whereHas('hasilPendaftaran', function ($q) {
                $q->where('status', 'selesai');
            })
            ->latest('id_peserta')
            ->take(5)
            ->get();

        // Semua alumni (untuk popup)
        $allAlumni = Peserta::with([
                'jurusan',
                'sekolahKampus'
            ])
            ->whereHas('hasilPendaftaran', function ($q) {
                $q->where('status', 'selesai');
            })
            ->latest('id_peserta')
            ->get();

        return view('landing', [
            'kuota' => $kuota->kuota_peserta,
            'pesertaAktif' => $pesertaAktif,
            'alumni' => $alumni,
            'allAlumni' => $allAlumni
        ]);
    }
}
