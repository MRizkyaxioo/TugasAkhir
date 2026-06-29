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

    $presensi = Presensi::whereDate('tanggal', $today)->first();

    $sudahPresensi = false;
    $closeTime = null;

    if ($presensi) {

        $record = PresensiPeserta::where('id_peserta', $peserta->id_peserta)
            ->where('id_presensi', $presensi->id_presensi)
            ->first();

        if ($record && $record->status_kehadiran != 'alpa') {
    $sudahPresensi = true;
}
        $closeTime = $presensi->jam_tutup;

        $now = Carbon::now();

        $tanggal = Carbon::parse($presensi->tanggal)->toDateString();

$jamBuka = Carbon::parse($presensi->tanggal)
    ->setTimeFromTimeString($presensi->jam_buka);

$jamTutup = Carbon::parse($presensi->tanggal)
    ->setTimeFromTimeString($presensi->jam_tutup);

if (
    $presensi->status != 'dibuka' ||
    $now->lt($jamBuka) ||
    $now->gt($jamTutup)
) {
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

    $presensi = Presensi::find($request->id_presensi);

    if (!$presensi) {
        return back()->with('error', 'Jadwal presensi tidak ditemukan.');
    }

    if ($presensi->status != 'dibuka') {
        return back()->with('error', 'Presensi belum dibuka.');
    }

    $now = Carbon::now();

    $jamBuka = Carbon::parse($presensi->tanggal)
    ->setTimeFromTimeString($presensi->jam_buka);

$jamTutup = Carbon::parse($presensi->tanggal)
    ->setTimeFromTimeString($presensi->jam_tutup);

if (
    $now->lt($jamBuka) ||
    $now->gt($jamTutup)
) {
    return back()->with('error', 'Waktu presensi sudah berakhir.');
}

    $record = PresensiPeserta::where('id_peserta', $peserta->id_peserta)
        ->where('id_presensi', $request->id_presensi)
        ->first();

    if ($record && $record->status_kehadiran != 'alpa') {
    return back()->with('error', 'Kamu sudah presensi hari ini.');
}

    $path = $record->surat_pendukung_izin ?? null;

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
