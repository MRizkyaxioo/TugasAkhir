<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\PresensiPeserta;
use App\Models\Peserta;
use Carbon\Carbon;
use App\Exports\RekapPresensiExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PresensiController extends Controller
{
    // Halaman utama presensi admin
    public function halamanPresensi()
    {
        $today = Carbon::now()->toDateString();

        // Ambil presensi hari ini (apapun statusnya) beserta peserta
        $presensi = Presensi::where('tanggal', $today)->first();

        $data = [];
        if ($presensi) {
            $data = PresensiPeserta::with('peserta')
                ->where('id_presensi', $presensi->id_presensi)
                ->get();
        }

        return view('admin.presensi', compact('data', 'presensi'));
    }

    // Simpan jadwal (pengganti buka presensi)
    public function aturWaktu(Request $request)
    {
        $request->validate([
            'tanggal'   => 'required|date',
            'jam_buka'  => 'required|date_format:H:i',
            'jam_tutup' => 'required|date_format:H:i|after:jam_buka',
        ]);

        $today = Carbon::now()->toDateString();
        if ($request->tanggal < $today) {
            return back()->with('error', 'Tidak bisa mengatur jadwal untuk tanggal kemarin.');
        }

        // Update or create presensi untuk tanggal tersebut
        $presensi = Presensi::updateOrCreate(
            ['tanggal' => $request->tanggal],
            [
                'jam_buka'  => $request->jam_buka,
                'jam_tutup' => $request->jam_tutup,
                'is_open'   => 0, // akan dibuka oleh scheduler
            ]
        );

        // Jika tanggal = hari ini, langsung generate peserta (biar langsung muncul di tabel)
        if ($request->tanggal == $today) {
            $pesertaAktif = Peserta::whereHas('hasilPendaftaran', function ($q) {
                $q->where('status', 'diterima');
            })->pluck('id_peserta');

            foreach ($pesertaAktif as $idPeserta) {
                PresensiPeserta::firstOrCreate(
                    [
                        'id_presensi' => $presensi->id_presensi,
                        'id_peserta'   => $idPeserta,
                    ],
                    [
                        'status_kehadiran' => 'alpa',
                        'tanggal_presensi' => null,
                        'is_final'         => 0,
                    ]
                );
            }
        }

        return back()->with('success', 'Jadwal presensi berhasil disimpan.');
    }

    // Simpan perubahan status saja (tanpa menutup)
    public function simpanStatus(Request $request)
    {
        if ($request->status) {
            foreach ($request->status as $id => $status) {
                PresensiPeserta::where('id_presensi_peserta', $id)
                    ->update(['status_kehadiran' => $status]);
            }
        }

        return back()->with('success', 'Status peserta diperbarui.');
    }

    // Tutup presensi manual + finalisasi (fungsi lama "Simpan Presensi")
    public function tutupPresensiManual()
    {
        $today = Carbon::now()->toDateString();
        $presensi = Presensi::where('tanggal', $today)->first();

        if (!$presensi) {
            return back()->with('error', 'Tidak ada presensi hari ini.');
        }

        $presensi->update([
            'is_open' => 0,
            'closed_at' => now(),
        ]);

        PresensiPeserta::where('id_presensi', $presensi->id_presensi)
            ->where('is_final', 0)
            ->update(['is_final' => 1]);

        return back()->with('success', 'Presensi ditutup & data disimpan final.');
    }

    // Rekap presensi (tidak berubah)
    public function rekapPresensi(Request $request)
    {
        $bulan = $request->bulan;

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

        if ($bulan) {
            $query->whereMonth('tanggal_presensi', $bulan);
        }

        $data = $query->groupBy('id_peserta')->get();

        return view('admin.rekap_presensi', compact('data', 'bulan'));
    }

    // Rekap surat (tidak berubah)
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
    $bulan = $request->bulan;

    $namaFile = 'rekap_presensi';

    if ($bulan) {
        $namaBulan = date('F', mktime(0, 0, 0, $bulan, 1));
        $namaFile .= '_' . strtolower($namaBulan);
    } else {
        $namaFile .= '_keseluruhan';
    }

    $namaFile .= '.xlsx';

    return Excel::download(
        new RekapPresensiExport($bulan),
        $namaFile
    );
}
}
