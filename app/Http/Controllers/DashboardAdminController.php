<?php

namespace App\Http\Controllers;

use App\Models\KuotaMagang;
use App\Models\Peserta;
use App\Models\HasilPendaftaran;
use App\Models\Pembimbing;
use App\Models\PembimbingPeserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
    public function calonPeserta(Request $request)
{
    $query = Peserta::whereHas('hasilPendaftaran', function ($q) {
        $q->where('status', 'pending');
    });

    // 🔍 Filter nama
    if ($request->nama) {
        $query->where('nama', 'like', '%' . $request->nama . '%');
    }

    // 🔍 Filter jurusan
    if ($request->jurusan) {
        $query->where('bidang_jurusan', 'like', '%' . $request->jurusan . '%');
    }

    // 🔍 Filter sekolah
    if ($request->sekolah) {
        $query->where('sekolah', 'like', '%' . $request->sekolah . '%');
    }

    if ($request->nisn) {
        $query->where('nisn', 'like', '%' . $request->nisn . '%');
    }

    $data = $query->with('hasilPendaftaran')->get();

    return view('admin.calon', compact('data'));
}

public function pesertaMagang(Request $request)
{
    $query = Peserta::whereHas('hasilPendaftaran', function ($q) {
        $q->where('status', 'diterima');
    });

    if ($request->nama) {
        $query->where('nama', 'like', '%' . $request->nama . '%');
    }

    if ($request->jurusan) {
        $query->where('bidang_jurusan', 'like', '%' . $request->jurusan . '%');
    }

    if ($request->sekolah) {
        $query->where('sekolah', 'like', '%' . $request->sekolah . '%');
    }

    if ($request->nisn) {
        $query->where('nisn', 'like', '%' . $request->nisn . '%');
    }

    $data = $query->with('hasilPendaftaran')->get();

    return view('admin.peserta', compact('data'));
}

    public function riwayat(Request $request)
{
    $query = Peserta::whereHas('hasilPendaftaran', function ($q) {
        $q->where('status', 'selesai');
    });

    // 🔍 Filter nama
    if ($request->nama) {
        $query->where('nama', 'like', '%' . $request->nama . '%');
    }

    // 🔍 Filter jurusan
    if ($request->jurusan) {
        $query->where('bidang_jurusan', 'like', '%' . $request->jurusan . '%');
    }

    // 🔍 Filter sekolah
    if ($request->sekolah) {
        $query->where('sekolah', 'like', '%' . $request->sekolah . '%');
    }

    // 🔍 Filter nisn
    if ($request->nisn) {
        $query->where('nisn', 'like', '%' . $request->nisn . '%');
    }

    $data = $query->with(['hasilPendaftaran', 'pembimbing'])->get();

    return view('admin.riwayat', compact('data'));
}

    // 🔹 Detail peserta
    public function detailPeserta($id)
    {
        $peserta = Peserta::with('hasilPendaftaran.berkas')
            ->findOrFail($id);

        return view('admin.detail', compact('peserta'));
    }

    public function detailPesertaAktif($id)
{
    $peserta = Peserta::with(['hasilPendaftaran.berkas', 'pembimbing'])
        ->findOrFail($id);

    $pembimbing = Pembimbing::all();

    return view('admin.detailpeserta', compact('peserta', 'pembimbing'));
}

// 🔹 Detail riwayat
    public function detailPesertaSelesai($id)
    {
        $peserta = Peserta::with('hasilPendaftaran.berkas')
            ->findOrFail($id);

        return view('admin.detailriwayat', compact('peserta'));
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

    public function selesai($id)
{
    HasilPendaftaran::where('id_peserta', $id)
        ->update(['status' => 'selesai']);

    return redirect()->route('admin.peserta')
        ->with('success', 'Peserta selesai magang');
}

public function assignPembimbing(Request $request, $id)
{
    $request->validate([
        'id_pembimbing' => 'required|exists:pembimbing_lapangan,id_pembimbing'
    ]);

    PembimbingPeserta::updateOrCreate(
        ['id_peserta' => $id],
        ['id_pembimbing' => $request->id_pembimbing]
    );

    return back()->with('success', 'Pembimbing berhasil ditentukan');
}

public function uploadBalasan(Request $request, $id)
{
    $request->validate([
        'file_balasan' => 'required|mimes:pdf|max:5120'
    ]);

    $file = $request->file('file_balasan');

    // rename biar gak tabrakan
    $filename = time().'_'.$file->getClientOriginalName();
    $path = $file->storeAs('balasan', $filename, 'public');

    HasilPendaftaran::where('id_peserta', $id)
        ->update([
            'file_berkas_balasan' => $path
        ]);

    return back()->with('success', 'Surat balasan berhasil diupload');
}

public function pembimbing()
{
    $data = Pembimbing::all();
    return view('admin.pembimbing', compact('data'));
}

public function storePembimbing(Request $request)
{
    $request->validate([
        'nama' => 'required',
        'nip_nidn' => 'required',
        'username' => 'required|unique:pembimbing_lapangan,username',
        'password' => 'required|min:5'
    ]);

    Pembimbing::create([
        'id_role' => 2, // default role pembimbing
        'nama' => $request->nama,
        'nip_nidn' => $request->nip_nidn,
        'username' => $request->username,
        'password' => Hash::make($request->password)
    ]);

    return back()->with('success', 'Pembimbing berhasil ditambahkan');
}

}
