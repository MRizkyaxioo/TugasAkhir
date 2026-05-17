<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peserta;
use App\Models\BerkasMagang;
use App\Models\HasilPendaftaran;
use App\Models\KuotaMagang;
use App\Models\Jurusan;
use App\Models\SekolahKampus;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class PesertaAuthController extends Controller
{

    public function showRegister()
{
    $kuota = KuotaMagang::find(1);

    if ($kuota->kuota_peserta <= 0) {
        return redirect('/')
            ->with('error', 'Pendaftaran ditutup');
    }

    $jurusan = Jurusan::all();
    $sekolah = SekolahKampus::all();

    return view('peserta.register', compact('jurusan', 'sekolah'));
}

    public function showLogin()
    {
        return view('peserta.login');
    }

    public function register(Request $request)
    {
        //CEK KUOTA
    $kuota = KuotaMagang::find(1);

    if ($kuota->kuota_peserta <= 0) {
        return back()->with('error', 'Pendaftaran ditutup');
    }

        $request->validate([
            'nama' => 'required',
            'nisn_nim' => 'required|unique:peserta,nisn_nim',
            'password' => 'required',
            'id_jurusan' => 'required|exists:jurusan,id_jurusan',
            'id_sekolah_kampus' => 'required|exists:sekolah_kampus,id_sekolah_kampus',
            'file_berkas' => 'required|file|mimes:pdf|max:5120',
            'awal_magang' => 'required|date',
            'akhir_magang' => 'required|date|after_or_equal:awal_magang',
        ], [
            // CUSTOM MESSAGE
            'file_berkas.required' => 'File wajib diupload',
            'file_berkas.mimes' => 'File harus berupa PDF',
            'file_berkas.max' => 'Ukuran maksimal 5MB',
        ]);

        DB::beginTransaction();

        try {
        // 1. Simpan peserta
        $peserta = Peserta::create([
            'nama' => $request->nama,
            'nisn_nim' => $request->nisn_nim,
            'password' => Hash::make($request->password),
            'id_jurusan' => $request->id_jurusan,
            'id_sekolah_kampus' => $request->id_sekolah_kampus,
            'semester' => $request->semester,
            'awal_magang' => $request->awal_magang,
            'akhir_magang' => $request->akhir_magang,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'kelas' => $request->kelas,
            'email' => $request->email,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);

        // 2. Upload berkas
        $file = $request->file('file_berkas')->store('berkas', 'public');

        $berkas = BerkasMagang::create([
            'id_peserta' => $peserta->id_peserta,
            'file_berkas' => $file
        ]);

        // 3. Hasil pendaftaran
        HasilPendaftaran::create([
            'id_peserta' => $peserta->id_peserta,
            'id_berkas' => $berkas->id_berkas,
            'file_berkas_balasan' => '',
            'status' => 'pending'
        ]);

        DB::commit();

        return redirect('/login-peserta')->with('success', 'Pendaftaran berhasil');

    } catch (\Exception $e) {
        DB::rollback();
        dd($e->getMessage());
        }
    }

    public function login(Request $request)
{
    $credentials = $request->only('nisn_nim', 'password');

    if (!Auth::guard('peserta')->attempt($credentials)) {
        return back()->with('error', 'Login gagal');
    }

    $request->session()->regenerate();

    $peserta = Auth::guard('peserta')->user();
    $status = $peserta->hasilPendaftaran->status ?? 'pending';

    if ($status == 'diterima') {
        return redirect('/dashboard-peserta');
    } else {
        return redirect('/dashboard-calon');
    }
}

public function logout(Request $request)
{
    Auth::guard('peserta')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login-peserta')->with('success', 'Berhasil logout');
}

}
