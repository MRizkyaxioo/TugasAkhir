<?php

namespace App\Http\Controllers;

use App\Models\KuotaMagang;
use App\Models\Peserta;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index()
    {
        // Total peserta diterima
    $total = Peserta::whereHas('hasilPendaftaran', function ($q) {
        $q->where('status', 'diterima');
    })->count();

    // Siswa (L)
    $siswa = Peserta::where('jenis_kelamin', 'L')
        ->whereHas('hasilPendaftaran', function ($q) {
            $q->where('status', 'diterima');
        })->count();

    // Siswi (P)
    $siswi = Peserta::where('jenis_kelamin', 'P')
        ->whereHas('hasilPendaftaran', function ($q) {
            $q->where('status', 'diterima');
        })->count();

    return view('admin.dashboard', compact('total', 'siswa', 'siswi'));
    }

    public function updateKuota(Request $request)
    {
        $request->validate([
            'kuota' => 'required|integer|min:0'
        ]);

        KuotaMagang::where('id_kuota', 1)
            ->update([
                'kuota_peserta' => $request->kuota
            ]);

        return back()->with('success', 'Kuota berhasil diupdate');
    }
}
