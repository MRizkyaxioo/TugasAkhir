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

public function updateProfil(Request $request)
{
    $peserta = Auth::guard('peserta')->user();

    $request->validate(
    [
        'nama' => 'required|string|max:60',
        'no_telp' => 'required|string|max:15',
        'email' => 'required|email|max:100|unique:peserta,email,' . $peserta->id_peserta . ',id_peserta',
    ],
    [
        'nama.required' => 'Nama wajib diisi.',
        'nama.max' => 'Nama maksimal 60 karakter.',

        'no_telp.required' => 'Nomor telepon wajib diisi.',
        'no_telp.max' => 'Nomor telepon maksimal 15 karakter.',

        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'email.unique' => 'Email tersebut sudah digunakan oleh peserta lain.',

        'alamat.required' => 'Alamat wajib diisi.',
    ]
);

    $peserta->update([
        'nama'    => $request->nama,
        'no_telp' => $request->no_telp,
        'email'   => $request->email,
        'alamat'  => $request->alamat,
    ]);

    return back()->with('success', 'Profil berhasil diperbarui.');
}

}
