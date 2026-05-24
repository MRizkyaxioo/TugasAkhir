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
    'nama' => 'required|string|max:255',

    'nisn_nim' => 'required|digits_between:1,11|unique:peserta,nisn_nim',

    'password' => 'required|min:6',

    'id_jurusan' => 'required|exists:jurusan,id_jurusan',

    'id_sekolah_kampus' => 'required|exists:sekolah_kampus,id_sekolah_kampus',

    'semester' => 'required|integer|min:1|max:14',

    'kelas' => 'required|string|max:50',

    'no_telp' => 'required|digits_between:10,15',

    'email' => 'required|email|unique:peserta,email',

    'jenis_kelamin' => 'required|in:L,P',

    'alamat' => 'required|string|max:255',

    'awal_magang' => 'required|date',

    'akhir_magang' => 'required|date|after_or_equal:awal_magang',

    'file_berkas' => 'required|file|mimes:pdf|max:5120',

], [

    // NAMA
    'nama.required' => 'Nama lengkap wajib diisi',
    'nama.max' => 'Nama maksimal 255 karakter',

    // NISN / NIM
    'nisn_nim.required' => 'NISN/NIM wajib diisi',
    'nisn_nim.digits_between' => 'NISN/NIM maksimal 11 digit',
    'nisn_nim.unique' => 'NISN/NIM sudah digunakan',

    // PASSWORD
    'password.required' => 'Password wajib diisi',
    'password.min' => 'Password minimal 6 karakter',

    // JURUSAN
    'id_jurusan.required' => 'Jurusan wajib dipilih',
    'id_jurusan.exists' => 'Jurusan tidak valid',

    // SEKOLAH
    'id_sekolah_kampus.required' => 'Sekolah/Kampus wajib dipilih',
    'id_sekolah_kampus.exists' => 'Sekolah/Kampus tidak valid',

    // SEMESTER
    'semester.required' => 'Semester wajib diisi',
    'semester.integer' => 'Semester harus berupa angka',
    'semester.min' => 'Semester minimal 1',
    'semester.max' => 'Semester maksimal 14',

    // KELAS
    'kelas.required' => 'Kelas wajib diisi',
    'kelas.max' => 'Kelas terlalu panjang',

    // NO TELP
    'no_telp.required' => 'Nomor telepon wajib diisi',
    'no_telp.digits_between' => 'Nomor telepon harus 10-15 digit',

    // EMAIL
    'email.required' => 'Email wajib diisi',
    'email.email' => 'Format email tidak valid',
    'email.unique' => 'Email sudah digunakan',

    // JENIS KELAMIN
    'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
    'jenis_kelamin.in' => 'Jenis kelamin tidak valid',

    // ALAMAT
    'alamat.required' => 'Alamat wajib diisi',
    'alamat.max' => 'Alamat terlalu panjang',

    // TANGGAL
    'awal_magang.required' => 'Tanggal awal magang wajib diisi',
    'awal_magang.date' => 'Format tanggal awal tidak valid',

    'akhir_magang.required' => 'Tanggal akhir magang wajib diisi',
    'akhir_magang.date' => 'Format tanggal akhir tidak valid',
    'akhir_magang.after_or_equal' => 'Tanggal akhir harus setelah atau sama dengan tanggal awal',

    // FILE
    'file_berkas.required' => 'File wajib diupload',
    'file_berkas.file' => 'Upload harus berupa file',
    'file_berkas.mimes' => 'File harus berupa PDF',
    'file_berkas.max' => 'Ukuran maksimal file 5MB',
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
