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

    $today = Carbon::today()->toDateString();

    // Ambil jadwal hari ini TANPA filter status
    $presensi = Presensi::whereDate('tanggal', $today)->first();

    $sudahPresensi = false;
    $closeTime = null;

    if ($presensi) {

        $record = PresensiPeserta::where('id_peserta', $peserta->id_peserta)
            ->where('id_presensi', $presensi->id_presensi)
            ->first();

        if ($record && $record->tanggal_presensi != null) {
            $sudahPresensi = true;
        }

        $closeTime = $presensi->jam_tutup;

        // Jika status bukan dibuka, anggap presensi belum bisa dilakukan
        if ($presensi->status != 'dibuka') {
            $presensi = null;
        }
    }

    return view(
        'peserta.dashboard',
        compact(
            'peserta',
            'presensi',
            'sudahPresensi',
            'closeTime'
        )
    );
}

public function kirimPresensi(Request $request)
{
    $peserta = Auth::guard('peserta')->user();

    $request->validate([
        'status' => 'required|in:hadir,izin,sakit',
        'id_presensi' => 'required'
    ]);

    // Cek apakah presensi memang sedang dibuka
    $presensi = Presensi::find($request->id_presensi);

if (!$presensi) {
    return back()->with('error', 'Jadwal presensi tidak ditemukan.');
}

if ($presensi->status != 'dibuka') {
    return back()->with('error', 'Presensi belum dibuka atau sudah ditutup.');
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
