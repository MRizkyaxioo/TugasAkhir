<?php

namespace App\Http\Controllers;
use App\Models\Presensi;
use App\Models\PresensiPeserta;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PresensiController extends Controller
{

public function halamanPresensi()
{
    $presensi = Presensi::where('is_open', 1)->latest()->first();

    $data = [];

    if ($presensi) {
        $data = PresensiPeserta::with('peserta')
            ->where('id_presensi', $presensi->id_presensi)
            ->get();
    }

    return view('admin.presensi', compact('data', 'presensi'));
}

    public function bukaPresensi()
{
    Presensi::create([
        'is_open' => 1,
        'opened_at' => now()
    ]);

    return back()->with('success', 'Presensi dibuka');
}

public function rekapPresensi()
{
    $data = PresensiPeserta::select(
        'id_peserta',
        DB::raw("SUM(status_kehadiran='hadir') as hadir"),
        DB::raw("SUM(status_kehadiran='izin') as izin"),
        DB::raw("SUM(status_kehadiran='sakit') as sakit"),
        DB::raw("SUM(status_kehadiran='alpha') as alpha")
    )
    ->with('peserta')

    ->whereHas('peserta.hasilPendaftaran', function ($q) {
        $q->where('status', 'diterima');
    })

    ->groupBy('id_peserta')
    ->get();

    return view('admin.rekap_presensi', compact('data'));
}

public function rekapSurat()
{
    $data = PresensiPeserta::with('peserta')
         ->whereHas('peserta.hasilPendaftaran', function ($q) {
                $q->where('status', 'diterima');
            })
        ->whereNotNull('surat_pendukung_izin')
        ->latest()
        ->get();

    return view('admin.rekap_surat', compact('data'));
}

public function simpanPresensi(Request $request)
{
    // 🔹 update status peserta
    if ($request->status) {
        foreach ($request->status as $id => $status) {
            PresensiPeserta::where('id_presensi_peserta', $id)
                ->update([
                    'status_kehadiran' => $status
                ]);
        }
    }

    // 🔥 AUTO TUTUP PRESENSI TERAKHIR
    $presensi = Presensi::latest()->first();

    if ($presensi) {
        $presensi->update([
            'is_open' => 0,
            'closed_at' => now()
        ]);
    }

    return back()->with('success', 'Presensi disimpan & ditutup');
}

}
