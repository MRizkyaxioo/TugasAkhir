<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardPembimbingController extends Controller
{
    public function index(Request $request)
{
    $pembimbing = Auth::guard('pembimbing')->user();


    $query = $pembimbing->peserta()
        ->whereHas('hasilPendaftaran', function ($q) {
            $q->whereIn('status', ['diterima', 'selesai']);
        });

    // 🔍 FILTER
    if ($request->nama) {
        $query->where('nama', 'like', '%' . $request->nama . '%');
    }

    if ($request->jurusan) {
        $query->where('bidang_jurusan', 'like', '%' . $request->jurusan . '%');
    }

    if ($request->sekolah) {
        $query->where('sekolah', 'like', '%' . $request->sekolah . '%');
    }

    if ($request->nisn) {
        $query->where('nisn', 'like', '%' . $request->nisn . '%');
    }

    $data = $query->with('hasilPendaftaran')->get();

    return view('pembimbing.dashboard', compact('data'));
}

    public function detail($id)
    {
        $peserta = Peserta::with([
            'hasilPendaftaran.berkas',
            'logbook',
            'presensiPeserta'
        ])->findOrFail($id);

        return view('pembimbing.detail', compact('peserta'));
    }
}
