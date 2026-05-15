<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Presensi;
use App\Models\PresensiPeserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardPesertaController extends Controller
{
    public function calon()
{
    $peserta = Auth::guard('peserta')->user();
    return view('peserta.calon', compact('peserta'));
}


public function peserta()
{
    $peserta = Auth::guard('peserta')->user();

    $status = $peserta->hasilPendaftaran->status;

    // ❌ BLOCK STATUS SELESAI
    if ($status == 'selesai') {
        return redirect()->route('peserta.selesai');
    }

    // ❌ BLOCK PENDING
    if ($status == 'pending') {
        return redirect()->route('dashboard-calon');
    }

    // ✅ HANYA DITERIMA
    $presensi = Presensi::where('is_open', 1)->latest()->first();

    $sudahPresensi = false;

    if ($presensi) {
        $sudahPresensi = PresensiPeserta::where('id_peserta', $peserta->id_peserta)
            ->where('id_presensi', $presensi->id_presensi)
            ->exists();
    }

    return view('peserta.dashboard', compact('peserta', 'presensi', 'sudahPresensi'));
}

public function kirimPresensi(Request $request)
{
    $peserta = Auth::guard('peserta')->user();

    // 🔥 VALIDASI STATUS
    $request->validate([
        'status' => 'required|in:hadir,izin,sakit',
        'id_presensi' => 'required'
    ]);

    // 🔥 CEK SUDAH PRESENSI BELUM
    $cek = PresensiPeserta::where('id_peserta', $peserta->id_peserta)
        ->where('id_presensi', $request->id_presensi)
        ->exists();

    if ($cek) {
        return back()->with('error', 'Kamu sudah presensi hari ini');
    }

    $path = null;

    // 🔥 WAJIB SURAT JIKA IZIN / SAKIT
    if (in_array($request->status, ['izin', 'sakit'])) {
        $request->validate([
            'surat' => 'required|mimes:pdf|max:5120'
        ]);

        $file = $request->file('surat');
        $filename = time().'_'.$file->getClientOriginalName();
        $path = $file->storeAs('surat_izin', $filename, 'public');
    }

    // 🔥 SIMPAN DATA
    PresensiPeserta::create([
        'id_peserta' => $peserta->id_peserta,
        'id_presensi' => $request->id_presensi,
        'status_kehadiran' => $request->status,
        'surat_pendukung_izin' => $path,
        'tanggal_presensi' => now(),
        'is_final' => 0
    ]);

    return back()->with('success', 'Presensi berhasil dikirim');
}

public function selesai()
{
    $peserta = Auth::guard('peserta')->user();

    return view('peserta.selesai', compact('peserta'));
}
}
