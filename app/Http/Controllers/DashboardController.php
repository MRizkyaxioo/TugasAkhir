<?php

namespace App\Http\Controllers;

use App\Models\HasilPendaftaran;
use App\Models\KuotaMagang;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $kuota = KuotaMagang::find(1);

        $pesertaAktif = HasilPendaftaran::where('status', 'diterima')->count();

        return view('landing', [
            'kuota' => $kuota->kuota_peserta,
            'pesertaAktif' => $pesertaAktif
        ]);
    }
}
