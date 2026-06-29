<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\PresensiPeserta;
use App\Models\Peserta;
use Carbon\Carbon;
use App\Exports\RekapPresensiExport;
use App\Exports\DetailPresensiExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PresensiController extends Controller
{
    // Halaman utama presensi admin
    public function halamanPresensi()
{
    // Auto close presensi yang kemarin lupa ditutup
Presensi::where('status', 'dibuka')
    ->whereDate('tanggal', '<', Carbon::today())
    ->update([
        'status' => 'ditutup'
    ]);

PresensiPeserta::whereHas('presensi', function ($q) {
    $q->where('status', 'ditutup');
})
->where('is_final', 0)
->update([
    'is_final' => 1
]);

    $today = Carbon::today()->toDateString();

    $presensi = Presensi::whereDate('tanggal', $today)->first();

    $data = [];

    if ($presensi) {
        $data = PresensiPeserta::with('peserta')
            ->where('id_presensi', $presensi->id_presensi)
            ->get();
    }

    return view(
        'admin.presensi',
        compact(
            'presensi',
            'data'
        )
    );
}

public function bukaPresensi(Request $request)
{
    $request->validate([
        'tanggal'   => 'required|date|after_or_equal:today',
        'jam_buka'  => 'required|date_format:H:i',
        'jam_tutup' => 'required|date_format:H:i|after:jam_buka',
    ]);

    $presensi = Presensi::whereDate('tanggal', $request->tanggal)->first();

    if ($presensi) {

        if ($presensi->status != 'belum_dibuka') {
            return back()->with(
                'error',
                'Presensi sudah dibuka atau sudah ditutup.'
            );
        }

        $presensi->update([
            'jam_buka'  => $request->jam_buka,
            'jam_tutup' => $request->jam_tutup,
            'status'    => 'dibuka',
        ]);

    } else {

        $presensi = Presensi::create([
            'tanggal'   => $request->tanggal,
            'jam_buka'  => $request->jam_buka,
            'jam_tutup' => $request->jam_tutup,
            'status'    => 'dibuka',
        ]);

    }

    $peserta = Peserta::whereHas('hasilPendaftaran', function ($q) {
        $q->where('status', 'diterima');
    })->get();

    foreach ($peserta as $p) {

        PresensiPeserta::firstOrCreate(
            [
                'id_presensi' => $presensi->id_presensi,
                'id_peserta'  => $p->id_peserta,
            ],
            [
                'status_kehadiran' => 'alpa',
                'tanggal_presensi' => $presensi->tanggal,
                'is_final'         => 0,
            ]
        );
    }

    return back()->with('success', 'Presensi berhasil dibuka.');
}


public function tutupPresensi($id)
{
    $presensi = Presensi::findOrFail($id);

    DB::transaction(function() use($presensi){

        $presensi->update([
            'status'=>'ditutup'
        ]);

        PresensiPeserta::where('id_presensi',$presensi->id_presensi)
            ->update([
                'is_final'=>1
            ]);

    });

    return back()->with('success','Presensi berhasil ditutup.');
}

public function simpanStatus(Request $request)
{
    foreach ($request->status as $id => $status) {

        PresensiPeserta::where(
            'id_presensi_peserta',
            $id
        )->update([
            'status_kehadiran' => $status
        ]);
    }

    return back()->with(
        'success',
        'Status kehadiran berhasil diperbarui.'
    );
}

    public function rekapPresensi(Request $request)
{
    $bulan   = $request->bulan;
    $tanggal = $request->tanggal;
    $nama    = $request->nama;

    $query = PresensiPeserta::select(
        'id_peserta',
        DB::raw("SUM(status_kehadiran='hadir') as hadir"),
        DB::raw("SUM(status_kehadiran='izin') as izin"),
        DB::raw("SUM(status_kehadiran='sakit') as sakit"),
        DB::raw("SUM(status_kehadiran='alpa') as alpa")
    )
    ->with('peserta')
    ->where('is_final', 1)
    ->whereHas('peserta.hasilPendaftaran', function ($q) {
        $q->where('status', 'diterima');
    });

    // FILTER BULAN
    if ($bulan) {
        $query->whereMonth('tanggal_presensi', $bulan);
    }

    // FILTER TANGGAL
    if ($tanggal) {
        $query->whereDate('tanggal_presensi', $tanggal);
    }

    // FILTER NAMA
    if ($nama) {
        $query->whereHas('peserta', function ($q) use ($nama) {
            $q->where('nama', 'like', '%' . $nama . '%');
        });
    }

    $data = $query->groupBy('id_peserta')->get();

    return view('admin.rekap_presensi', compact(
        'data',
        'bulan',
        'tanggal',
        'nama'
    ));
}

    public function rekapSurat()
    {
        $data = PresensiPeserta::with('peserta')
            ->where('is_final', 1)
            ->whereHas('peserta.hasilPendaftaran', function ($q) {
                $q->where('status', 'diterima');
            })
            ->whereNotNull('surat_pendukung_izin')
            ->latest()
            ->get();

        return view('admin.rekap_surat', compact('data'));
    }

    public function exportRekapPresensi(Request $request)
{
    $bulan   = $request->bulan;
    $tanggal = $request->tanggal;
    $nama    = $request->nama;

    $namaFile = 'rekap_presensi';

    // tanggal
    if ($tanggal) {
        $namaFile .= '_' . $tanggal;
    }

    // bulan
    if ($bulan) {
        $namaBulan = strtolower(date('F', mktime(0, 0, 0, $bulan, 1)));
        $namaFile .= '_' . $namaBulan;
    }

    // nama
    if ($nama) {
        $namaPeserta = strtolower(str_replace(' ', '_', $nama));
        $namaFile .= '_' . $namaPeserta;
    }

    $namaFile .= '.xlsx';

    return Excel::download(
        new RekapPresensiExport($bulan, $tanggal, $nama),
        $namaFile
    );
}

public function detailPresensi($id)
    {
        $peserta = Peserta::findOrFail($id);

        $presensiData = PresensiPeserta::with('presensi')
            ->where('id_peserta', $id)
            ->where('is_final', 1)
            ->orderBy('tanggal_presensi', 'desc')
            ->get();

        return view('admin.detail_presensi', compact('peserta', 'presensiData'));
    }

    public function exportDetailPresensi($id)
{
    $peserta = Peserta::findOrFail($id);

    $presensiData = PresensiPeserta::where('id_peserta', $id)
        ->where('is_final', 1)
        ->orderBy('tanggal_presensi', 'asc')
        ->get();

    $namaFile = 'presensi_' . strtolower(str_replace(' ', '_', $peserta->nama)) . '.xlsx';

    return Excel::download(
        new \App\Exports\DetailPresensiExport($peserta, $presensiData),
        $namaFile
    );
}
}
