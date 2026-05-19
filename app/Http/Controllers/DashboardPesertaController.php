<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Presensi;
use App\Models\PresensiPeserta;
use Carbon\Carbon;
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
    $peserta = Auth::guard('peserta')
    ->user()
    ->load('pembimbing');
    $status = $peserta->hasilPendaftaran->status;

    if ($status == 'selesai') {
        return redirect()->route('peserta.selesai');
    }
    if ($status == 'pending') {
        return redirect()->route('dashboard-calon');
    }

    $today = Carbon::now()->toDateString();
    $presensi = Presensi::where('tanggal', $today)
                ->where('is_open', 1)
                ->first();

    $sudahPresensi = false;
    $closeTime = null;

    if ($presensi) {
        // Cek apakah peserta sudah benar-benar melakukan presensi (tanggal_presensi terisi)
        $record = PresensiPeserta::where('id_peserta', $peserta->id_peserta)
                    ->where('id_presensi', $presensi->id_presensi)
                    ->first();

        if ($record && $record->tanggal_presensi !== null) {
            $sudahPresensi = true;
        }

        $closeTime = $presensi->jam_tutup;
    }

    return view('peserta.dashboard', compact('peserta', 'presensi', 'sudahPresensi', 'closeTime'));
}

public function kirimPresensi(Request $request)
{
    $peserta = Auth::guard('peserta')->user();

    $request->validate([
        'status' => 'required|in:hadir,izin,sakit',
        'id_presensi' => 'required'
    ]);

    // Cek apakah presensi memang sedang dibuka
    $presensi = Presensi::where('id_presensi', $request->id_presensi)
                ->where('is_open', 1)
                ->first();

    if (!$presensi) {
        return back()->with('error', 'Presensi tidak tersedia atau sudah ditutup.');
    }

    // Ambil record default (jika ada) atau fallback
    $record = PresensiPeserta::where('id_peserta', $peserta->id_peserta)
                ->where('id_presensi', $request->id_presensi)
                ->first();

    // Cek apakah sudah benar-benar presensi (sudah ada tanggal)
    if ($record && $record->tanggal_presensi !== null) {
        return back()->with('error', 'Kamu sudah presensi hari ini');
    }

    $path = $record->surat_pendukung_izin ?? null; // ambil surat lama jika ada

    // Jika izin/sakit, wajib upload surat baru
    if (in_array($request->status, ['izin', 'sakit'])) {
        $request->validate([
            'surat' => 'required|mimes:pdf|max:5120'
        ]);

        $file = $request->file('surat');
        $filename = time().'_'.$file->getClientOriginalName();
        $path = $file->storeAs('surat_izin', $filename, 'public');
    }

    $dataUpdate = [
        'status_kehadiran' => $request->status,
        'surat_pendukung_izin' => $path,
        'tanggal_presensi' => now(),
    ];

    if ($record) {
        $record->update($dataUpdate);
    } else {
        // fallback jika record default belum dibuat (seharusnya sudah ada)
        PresensiPeserta::create(array_merge($dataUpdate, [
            'id_peserta' => $peserta->id_peserta,
            'id_presensi' => $request->id_presensi,
            'is_final' => 0,
        ]));
    }

    return back()->with('success', 'Presensi berhasil dikirim');
}

public function selesai()
{
    $peserta = Auth::guard('peserta')->user();

    return view('peserta.selesai', compact('peserta'));
}
}
