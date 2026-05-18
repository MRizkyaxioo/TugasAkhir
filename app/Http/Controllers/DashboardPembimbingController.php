<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Jurusan;
use App\Models\SekolahKampus;
use Illuminate\Http\Request;
use App\Models\Logbook;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardPembimbingController extends Controller
{
    public function index(Request $request)
    {
        $pembimbing = Auth::guard('pembimbing')->user();

        $query = $pembimbing->peserta()
            ->with([
                'hasilPendaftaran',
                'jurusan',
                'sekolahKampus'
            ])
            ->whereHas('hasilPendaftaran', function ($q) {
                $q->whereIn('status', ['diterima', 'selesai']);
            });

        // FILTER NAMA
        if ($request->nama) {
            $query->where('nama', 'like', '%' . $request->nama . '%');
        }

        // FILTER JURUSAN
        if ($request->jurusan) {
            $query->where('id_jurusan', $request->jurusan);
        }

        // FILTER SEKOLAH/KAMPUS
        if ($request->sekolah_kampus) {
            $query->where('id_sekolah_kampus', $request->sekolah_kampus);
        }

        // FILTER STATUS
if ($request->status) {
    $query->whereHas('hasilPendaftaran', function ($q) use ($request) {
        $q->where('status', $request->status);
    });
}

        // FILTER NISN/NIM
        if ($request->nisn_nim) {
            $query->where('nisn_nim', 'like', '%' . $request->nisn_nim . '%');
        }

        $data = $query->paginate(5)->withQueryString();

        // dropdown
        $jurusan = Jurusan::orderBy('jurusan')->get();
        $sekolah = SekolahKampus::orderBy('nama_sekolah_kampus')->get();

        return view('pembimbing.dashboard', compact(
            'data',
            'jurusan',
            'sekolah'
        ));
    }

    public function logbook($id)
    {
        $pembimbing = Auth::guard('pembimbing')->user();

        $peserta = $pembimbing->peserta()
                    ->with(['jurusan', 'sekolahKampus'])
                    ->where('peserta.id_peserta', $id)
                    ->firstOrFail();

        $data = Logbook::where('id_peserta', $id)
                ->orderBy('tanggal', 'asc')
                ->get();

        return view('pembimbing.logbook', compact('peserta', 'data'));
    }

    public function exportLogbookPembimbing($id)
{
    $pembimbing = Auth::guard('pembimbing')->user();

    // Pastikan peserta memang milik pembimbing ini
    $peserta = Peserta::whereHas('pembimbing', function ($q) use ($pembimbing) {
        $q->where('pembimbing_lapangan.id_pembimbing', $pembimbing->id_pembimbing);
    })->findOrFail($id);

    $data = Logbook::where('id_peserta', $id)
        ->orderBy('tanggal', 'asc')
        ->get();

    $pdf = Pdf::loadView('pembimbing.logbook_pdf', compact('peserta', 'data'))
        ->setPaper('A4', 'portrait');

    return $pdf->download('logbook_'.$peserta->nama.'.pdf');
}

    public function detail($id)
{
    $peserta = Peserta::with([
        'hasilPendaftaran.berkas',
        'logbook',
        'presensiPeserta',
        'jurusan',
        'sekolahKampus',
        'pembimbing'
    ])->findOrFail($id);

    // Hitung rekap presensi
    $hadir = $peserta->presensiPeserta()
        ->where('status_kehadiran', 'hadir')
        ->count();

    $sakit = $peserta->presensiPeserta()
        ->where('status_kehadiran', 'sakit')
        ->count();

    $izin = $peserta->presensiPeserta()
        ->where('status_kehadiran', 'izin')
        ->count();

    $alpa = $peserta->presensiPeserta()
        ->where('status_kehadiran', 'alpa')
        ->count();

    return view('pembimbing.detail', compact(
        'peserta',
        'hadir',
        'sakit',
        'izin',
        'alpa'
    ));
}

public function exportPesertaPdf(Request $request)
{
    $pembimbing = Auth::guard('pembimbing')->user();

    $query = $pembimbing->peserta()
        ->with([
            'hasilPendaftaran',
            'jurusan',
            'sekolahKampus'
        ])
        ->whereHas('hasilPendaftaran', function ($q) {
            $q->whereIn('status', ['diterima', 'selesai']);
        });

    // FILTER NAMA
    if ($request->nama) {
        $query->where('nama', 'like', '%' . $request->nama . '%');
    }

    // FILTER JURUSAN
    if ($request->jurusan) {
        $query->where('id_jurusan', $request->jurusan);
    }

    // FILTER SEKOLAH/KAMPUS
    if ($request->sekolah_kampus) {
        $query->where('id_sekolah_kampus', $request->sekolah_kampus);
    }

    // FILTER STATUS
    if ($request->status) {
        $query->whereHas('hasilPendaftaran', function ($q) use ($request) {
            $q->where('status', $request->status);
        });
    }

    // FILTER NISN/NIM
    if ($request->nisn_nim) {
        $query->where('nisn_nim', 'like', '%' . $request->nisn_nim . '%');
    }

    $data = $query->get();

    $pdf = Pdf::loadView(
        'pembimbing.peserta_pdf',
        compact('data', 'pembimbing')
    )->setPaper('A4', 'portrait');

    return $pdf->download('data_peserta_bimbingan.pdf');
}

}
