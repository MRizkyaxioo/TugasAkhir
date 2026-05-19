<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Jurusan;
use App\Models\SekolahKampus;
use App\Models\Logbook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardPembimbingAsalController extends Controller
{
    public function index(Request $request)
    {
        $pembimbing = Auth::guard('pembimbing_asal')->user();

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

        $data = $query->paginate(5)->withQueryString();

        $jurusan = Jurusan::orderBy('jurusan')->get();
        $sekolah = SekolahKampus::orderBy('nama_sekolah_kampus')->get();

        return view('pembimbing_asal.dashboard', compact(
            'data',
            'jurusan',
            'sekolah'
        ));
    }

    public function detail($id)
    {
        $peserta = Peserta::with([
            'hasilPendaftaran.berkas',
            'logbook',
            'presensiPeserta',
            'jurusan',
            'sekolahKampus',
            'pembimbing',
            'pembimbingAsal',
            'penilaian.kriteria'
        ])->findOrFail($id);

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

        return view('pembimbing_asal.detail', compact(
            'peserta',
            'hadir',
            'sakit',
            'izin',
            'alpa'
        ));
    }

    public function logbook($id)
    {
        $pembimbing = Auth::guard('pembimbing_asal')->user();

        $peserta = $pembimbing->peserta()
                    ->with(['jurusan', 'sekolahKampus'])
                    ->where('peserta.id_peserta', $id)
                    ->firstOrFail();

        $data = Logbook::where('id_peserta', $id)
                ->orderBy('tanggal', 'asc')
                ->get();

        return view('pembimbing_asal.logbook', compact('peserta', 'data'));
    }
}
