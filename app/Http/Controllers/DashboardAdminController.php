<?php

namespace App\Http\Controllers;

use App\Models\KuotaMagang;
use App\Models\Peserta;
use App\Models\HasilPendaftaran;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index()
    {
        // Total peserta diterima
    $total = Peserta::whereHas('hasilPendaftaran', function ($q) {
        $q->where('status', 'diterima');
    })->count();

    // Siswa (L)
    $siswa = Peserta::where('jenis_kelamin', 'L')
        ->whereHas('hasilPendaftaran', function ($q) {
            $q->where('status', 'diterima');
        })->count();

    // Siswi (P)
    $siswi = Peserta::where('jenis_kelamin', 'P')
        ->whereHas('hasilPendaftaran', function ($q) {
            $q->where('status', 'diterima');
        })->count();

    return view('admin.dashboard', compact('total', 'siswa', 'siswi'));
    }

    public function updateKuota(Request $request)
    {
        $request->validate([
            'kuota' => 'required|integer|min:0'
        ]);

        KuotaMagang::where('id_kuota', 1)
            ->update([
                'kuota_peserta' => $request->kuota
            ]);

        return back()->with('success', 'Kuota berhasil diupdate');
    }

    // 🔹 List calon peserta (pending)
    public function calonPeserta()
    {
        $data = Peserta::whereHas('hasilPendaftaran', function ($q) {
            $q->where('status', 'pending');
        })->with('hasilPendaftaran')->get();

        return view('admin.calon', compact('data'));
    }

    // 🔹 Detail peserta
    public function detailPeserta($id)
    {
        $peserta = Peserta::with('hasilPendaftaran.berkas')
            ->findOrFail($id);

        return view('admin.detail', compact('peserta'));
    }

    // 🔹 Terima peserta
    public function terima($id)
    {
        HasilPendaftaran::where('id_peserta', $id)
            ->update(['status' => 'diterima']);

        return redirect()->route('admin.calon')->with('success', 'Peserta diterima');
    }

    // 🔹 Tolak peserta
    public function tolak($id)
    {
        HasilPendaftaran::where('id_peserta', $id)
            ->update(['status' => 'ditolak']);

        return redirect()->route('admin.calon')->with('success', 'Peserta ditolak');
    }

    // 🔹 Peserta magang (diterima)
    public function pesertaMagang()
    {
        $data = Peserta::whereHas('hasilPendaftaran', function ($q) {
            $q->where('status', 'diterima');
        })->get();

        return view('admin.peserta', compact('data'));
    }

    // 🔹 Riwayat (selesai)
    public function riwayat()
    {
        $data = Peserta::whereHas('hasilPendaftaran', function ($q) {
            $q->where('status', 'selesai');
        })->get();

        return view('admin.riwayat', compact('data'));
    }
}
