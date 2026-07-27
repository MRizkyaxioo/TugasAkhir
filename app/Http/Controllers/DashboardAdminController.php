<?php

namespace App\Http\Controllers;

use App\Mail\PesertaDiterimaMail;
use App\Mail\PesertaDitolakMail;
use App\Models\KuotaMagang;
use App\Models\Peserta;
use App\Models\HasilPendaftaran;
use App\Models\Logbook;
use App\Models\KepalaPerpustakaan;
use App\Models\Pembimbing;
use App\Models\PembimbingPeserta;
use App\Models\PresensiPeserta;
use App\Models\Jurusan;
use App\Models\PembimbingAsal;
use App\Models\SekolahKampus;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
    $query = Peserta::with([
        'hasilPendaftaran',
        'jurusan',
        'sekolahKampus'
    ])->whereHas('hasilPendaftaran', function ($q) {
        $q->where('status', 'pending');
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

    // FILTER NISN/NIM
    if ($request->nisn_nim) {
        $query->where('nisn_nim', 'like', '%' . $request->nisn_nim . '%');
    }

    $data = $query->paginate(5)->withQueryString();

    // dropdown data
    $jurusan = Jurusan::orderBy('jurusan')->get();
    $sekolah = SekolahKampus::orderBy('nama_sekolah_kampus')->get();

    return view('admin.calon', compact(
        'data',
        'jurusan',
        'sekolah'
    ));
}

public function pesertaMagang(Request $request)
{
    $query = Peserta::with([
        'hasilPendaftaran',
        'jurusan',
        'sekolahKampus'
    ])->whereHas('hasilPendaftaran', function ($q) {
        $q->where('status', 'diterima');
    });

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

    if ($request->nisn_nim) {
        $query->where('nisn_nim', 'like', '%' . $request->nisn_nim . '%');
    }

    $data = $query->with('hasilPendaftaran')
    ->paginate(5)
    ->withQueryString();

    // dropdown
    $jurusan = Jurusan::orderBy('jurusan')->get();
    $sekolah = SekolahKampus::orderBy('nama_sekolah_kampus')->get();

    return view('admin.peserta', compact('data', 'jurusan',
        'sekolah'));
}

    public function riwayat(Request $request)
{
    $query = Peserta::with([
        'hasilPendaftaran',
        'jurusan',
        'sekolahKampus'
    ])->whereHas('hasilPendaftaran', function ($q) {
        $q->where('status', 'selesai');
    });

    // 🔍 Filter nama
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

    // 🔍 Filter nisn/nim
    if ($request->nisn_nim) {
        $query->where('nisn_nim', 'like', '%' . $request->nisn_nim . '%');
    }

    $data = $query->with(['hasilPendaftaran', 'pembimbing'])
    ->paginate(5)
    ->withQueryString();

    // dropdown
    $jurusan = Jurusan::orderBy('jurusan')->get();
    $sekolah = SekolahKampus::orderBy('nama_sekolah_kampus')->get();

    return view('admin.riwayat', compact('data', 'jurusan',
        'sekolah'));
}

    // 🔹 Detail peserta
    public function detailPeserta($id)
    {
        $peserta = Peserta::with([
        'hasilPendaftaran.berkas',
        'jurusan',
        'sekolahKampus'
    ])->findOrFail($id);

    return view('admin.detail', compact('peserta'));
    }

    public function detailPesertaAktif($id)
{
    $peserta = Peserta::with([
        'hasilPendaftaran.berkas',
        'jurusan',
        'sekolahKampus',
        'pembimbing',
        'pembimbingAsal'
    ])->findOrFail($id);

    $pembimbing = Pembimbing::all();

    // hanya pembimbing asal dari sekolah/kampus peserta
    $pembimbingAsal = PembimbingAsal::where(
        'id_sekolah_kampus',
        $peserta->id_sekolah_kampus
    )->get();

    // dropdown data — WAJIB untuk fitur edit jurusan/sekolah
    $jurusan = Jurusan::orderBy('jurusan')->get();
    $sekolah = SekolahKampus::orderBy('nama_sekolah_kampus')->get();

    return view(
        'admin.detailpeserta',
        compact('peserta', 'pembimbing', 'pembimbingAsal', 'jurusan', 'sekolah')
    );
}

// 🔹 Detail riwayat
    public function detailPesertaSelesai($id)
{
    $peserta = Peserta::with([
        'hasilPendaftaran.berkas',
        'jurusan',
        'sekolahKampus',
        'pembimbing',
        'penilaian.kriteria'
    ])->findOrFail($id);

    return view('admin.detailriwayat', compact('peserta'));
}

    // 🔹 Terima peserta
    public function terima($id)
    {
        HasilPendaftaran::where('id_peserta', $id)
            ->update(['status' => 'diterima']);

        $peserta = Peserta::findOrFail($id);

        //kirim email
        if ($peserta->email) {
            Mail::to($peserta->email)->send(new PesertaDiterimaMail($peserta));
        }

        return redirect()->route('admin.calon')->with('success', 'Peserta diterima');
    }

    // 🔹 Tolak peserta
    public function tolak($id)
{
    $peserta = Peserta::findOrFail($id);

    //kirim email
        if ($peserta->email) {
            Mail::to($peserta->email)->send(new PesertaDitolakMail($peserta));
        }

    // hapus hasil pendaftaran
    HasilPendaftaran::where('id_peserta', $id)->delete();

    // hapus peserta
    $peserta->delete();

    return redirect()->route('admin.calon')
        ->with('success', 'Peserta berhasil ditolak dan dihapus');
}

    public function selesai($id)
{
    HasilPendaftaran::where('id_peserta', $id)
        ->update(['status' => 'selesai']);

    // 🔥 hapus presensi & surat izin
    PresensiPeserta::where('id_peserta', $id)->delete();

    return redirect()->route('admin.peserta')
        ->with('success', 'Peserta selesai & data presensi dibersihkan');
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

    $pembimbingAsal = PembimbingAsal::all();

    $sekolah = SekolahKampus::orderBy('nama_sekolah_kampus')->get();

    $kepala = KepalaPerpustakaan::first();

    return view('admin.pembimbing', compact(
        'data',
        'pembimbingAsal',
        'sekolah',
        'kepala'
    ));
}

public function updateKepalaPerpustakaan(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:100',
        'nip'  => 'required|string|max:30',
    ]);

    $kepala = KepalaPerpustakaan::first();

    if ($kepala) {
        $kepala->update([
            'nama' => $request->nama,
            'nip'  => $request->nip,
        ]);
    } else {
        KepalaPerpustakaan::create([
            'nama' => $request->nama,
            'nip'  => $request->nip,
        ]);
    }

    return back()->with('success', 'Data Kepala Perpustakaan berhasil diupdate');
}

public function storePembimbing(Request $request)
{
    $request->validate([
        'nama' => 'required',
        'no_telp' => 'required',
        'nip_nidn' => 'required',
        'username' => 'required|unique:pembimbing_lapangan,username',
        'password' => 'required|min:5'
    ]);

    Pembimbing::create([
        'id_role' => 2, // role pembimbing
        'nama' => $request->nama,
        'no_telp' => $request->no_telp,
        'nip_nidn' => $request->nip_nidn,
        'username' => $request->username,
        'password' => Hash::make($request->password)
    ]);

    return back()->with('success', 'Pembimbing berhasil ditambahkan');
}

public function logbookPeserta($id)
{
    $peserta = Peserta::findOrFail($id);
    $data = Logbook::where('id_peserta', $id)
        ->orderBy('tanggal', 'asc')
        ->get();

    return view('admin.logbook', compact('peserta', 'data'));
}

public function exportLogbookAdmin($id)
{
    $peserta = Peserta::with(['jurusan', 'sekolahKampus'])
        ->findOrFail($id);

    $data = Logbook::where('id_peserta', $id)
        ->orderBy('tanggal', 'asc')
        ->get();

    $pdf = Pdf::loadView('peserta.logbook_pdf', compact('peserta', 'data'))
        ->setPaper('A4', 'portrait');

    return $pdf->download('logbook_'.$peserta->nama.'.pdf');
}

// =========================================================
// 🔹 LOGBOOK - ADMIN TAMBAH / EDIT / HAPUS
// =========================================================
public function storeLogbookAdmin(Request $request, $peserta)
{
    $request->validate([
        'tanggal' => 'required|date|before_or_equal:today',
        'kegiatan' => 'required|string',
        'bukti_foto' => 'nullable|mimes:jpeg,png,jpg,gif,heic,heif|max:5120',
    ], [
        'tanggal.required' => 'Tanggal wajib diisi.',
        'tanggal.before_or_equal' => 'Tanggal tidak boleh melebihi hari ini.',
        'kegiatan.required' => 'Kegiatan wajib diisi.',
        'bukti_foto.mimes' => 'Format gambar harus JPG, JPEG, PNG, GIF, HEIC, atau HEIF.',
        'bukti_foto.max' => 'Ukuran gambar maksimal 5 MB.',
    ]);

    $path = null;
if ($request->hasFile('bukti_foto')) {
    $file = $request->file('bukti_foto');
    $mime = strtolower($file->getMimeType());

    if (in_array($mime, ['image/heic', 'image/heif'])) {
        $imagick = new \Imagick($file->getRealPath());
        $imagick->setImageFormat('jpeg');
        $filename = time().'_'.pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME).'.jpg';
        Storage::disk('public')->put('logbook/'.$filename, $imagick->getImageBlob());
        $path = 'logbook/'.$filename;
    } else {
        $filename = time().'_'.$file->getClientOriginalName();
        $path = $file->storeAs('logbook', $filename, 'public');
    }
}

    $logbook = Logbook::create([
        'id_peserta' => $peserta,
        'tanggal' => $request->tanggal,
        'kegiatan' => $request->kegiatan,
        'bukti_foto' => $path,
    ]);

    return response()->json([
        'message' => 'Logbook berhasil ditambahkan',
        'data' => [
            'id_logbook' => $logbook->id_logbook,
            'tanggal' => Carbon::parse($logbook->tanggal)->format('d-m-Y'),
            'kegiatan' => $logbook->kegiatan,
            'bukti_foto' => $logbook->bukti_foto ? asset('storage/'.$logbook->bukti_foto) : null,
        ]
    ]);
}

public function updateLogbookAdmin(Request $request, $id)
{
    $logbook = Logbook::findOrFail($id);

    $request->validate([
        'tanggal' => 'required|date|before_or_equal:today',
        'kegiatan' => 'required|string',
        'bukti_foto' => 'nullable|mimes:jpeg,png,jpg,gif,heic,heif|max:5120',
    ], [
        'tanggal.required' => 'Tanggal wajib diisi.',
        'tanggal.before_or_equal' => 'Tanggal tidak boleh melebihi hari ini.',
        'kegiatan.required' => 'Kegiatan wajib diisi.',
        'bukti_foto.mimes' => 'Format gambar harus JPG, JPEG, PNG, GIF, HEIC, atau HEIF.',
        'bukti_foto.max' => 'Ukuran gambar maksimal 5 MB.',
    ]);

    $path = $logbook->bukti_foto;
if ($request->hasFile('bukti_foto')) {
    if ($path && Storage::disk('public')->exists($path)) {
        Storage::disk('public')->delete($path);
    }

    $file = $request->file('bukti_foto');
    $mime = strtolower($file->getMimeType());

    if (in_array($mime, ['image/heic', 'image/heif'])) {
        $imagick = new \Imagick($file->getRealPath());
        $imagick->setImageFormat('jpeg');
        $filename = time().'_'.pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME).'.jpg';
        Storage::disk('public')->put('logbook/'.$filename, $imagick->getImageBlob());
        $path = 'logbook/'.$filename;
    } else {
        $filename = time().'_'.$file->getClientOriginalName();
        $path = $file->storeAs('logbook', $filename, 'public');
    }
}

    $logbook->update([
        'tanggal' => $request->tanggal,
        'kegiatan' => $request->kegiatan,
        'bukti_foto' => $path,
    ]);

    return response()->json([
        'message' => 'Logbook berhasil diperbarui',
        'data' => [
            'id_logbook' => $logbook->id_logbook,
            'tanggal' => Carbon::parse($logbook->tanggal)->format('d-m-Y'),
            'kegiatan' => $logbook->kegiatan,
            'bukti_foto' => $logbook->bukti_foto ? asset('storage/'.$logbook->bukti_foto) : null,
        ]
    ]);
}

public function deleteLogbookAdmin($id)
{
    $logbook = Logbook::findOrFail($id);

    if ($logbook->bukti_foto && Storage::disk('public')->exists($logbook->bukti_foto)) {
        Storage::disk('public')->delete($logbook->bukti_foto);
    }

    $logbook->delete();

    return response()->json(['message' => 'Logbook berhasil dihapus']);
}

public function jurusan(Request $request)
{
    $query = Jurusan::query();

    if ($request->filled('search')) {
        $query->where('jurusan', 'like', '%' . $request->search . '%');
    }

    $data = $query
        ->orderBy('jurusan')
        ->paginate(10)
        ->withQueryString();

    return view('admin.jurusan', compact('data'));
}

public function storeJurusan(Request $request)
{
    $request->validate([
        'jurusan' => 'required|string|max:50|unique:jurusan,jurusan'
    ], [
        'jurusan.unique' => 'Nama jurusan ini sudah terdaftar.',
    ]);

    Jurusan::create([
        'jurusan' => $request->jurusan
    ]);

    return back()->with('success', 'Jurusan berhasil ditambahkan');
}

public function sekolahKampus(Request $request)
{
    $query = SekolahKampus::query();

    if ($request->filled('search')) {
        $query->where('nama_sekolah_kampus', 'like', '%' . $request->search . '%');
    }

    $data = $query
        ->orderBy('nama_sekolah_kampus')
        ->paginate(10)
        ->withQueryString();

    return view('admin.sekolah', compact('data'));
}

public function storeSekolahKampus(Request $request)
{
    $request->validate([
        'nama_sekolah_kampus' => 'required|string|max:75|unique:sekolah_kampus,nama_sekolah_kampus'
    ], [
        'nama_sekolah_kampus.unique' => 'Nama sekolah/kampus ini sudah terdaftar.',
    ]);

    SekolahKampus::create([
        'nama_sekolah_kampus' => $request->nama_sekolah_kampus
    ]);

    return back()->with('success', 'Sekolah/Kampus berhasil ditambahkan');
}

public function updateJurusan(Request $request, $id)
{
    $request->validate([
        'jurusan' => 'required|string|max:50|unique:jurusan,jurusan,' . $id . ',id_jurusan'
    ], [
        'jurusan.unique' => 'Nama jurusan ini sudah terdaftar.',
    ]);

    $jurusan = Jurusan::findOrFail($id);

    $jurusan->update([
        'jurusan' => $request->jurusan
    ]);

    return back()->with('success', 'Jurusan berhasil diupdate');
}

public function updateSekolahKampus(Request $request, $id)
{
    $request->validate([
        'nama_sekolah_kampus' => 'required|string|max:75|unique:sekolah_kampus,nama_sekolah_kampus,' . $id . ',id_sekolah_kampus'
    ], [
        'nama_sekolah_kampus.unique' => 'Nama sekolah/kampus ini sudah terdaftar.',
    ]);

    $sekolah = SekolahKampus::findOrFail($id);

    $sekolah->update([
        'nama_sekolah_kampus' => $request->nama_sekolah_kampus
    ]);

    return back()->with('success', 'Sekolah/Kampus berhasil diupdate');
}

public function deleteJurusan($id)
{
    \App\Models\Jurusan::findOrFail($id)->delete();
    return back()->with('success', 'Jurusan berhasil dihapus');
}

public function deleteSekolahKampus($id)
{
    \App\Models\SekolahKampus::findOrFail($id)->delete();
    return back()->with('success', 'Sekolah/Kampus berhasil dihapus');
}

public function updatePembimbing(Request $request, $id)
{
    $request->validate([
        'nama' => 'required',
        'no_telp' => 'required',
        'nip_nidn' => 'required',
        'username' => 'required|unique:pembimbing_lapangan,username,' . $id . ',id_pembimbing',
        'password' => 'nullable|min:5'
    ]);

    $pembimbing = Pembimbing::findOrFail($id);

    $data = [
        'nama' => $request->nama,
        'no_telp' => $request->no_telp,
        'nip_nidn' => $request->nip_nidn,
        'username' => $request->username,
    ];

    // jika password diisi
    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    $pembimbing->update($data);

    return back()->with('success', 'Data pembimbing berhasil diupdate');
}

public function deletePembimbing($id)
{
    $pembimbing = Pembimbing::findOrFail($id);

    // cegah hapus kalau masih jadi pembimbing aktif peserta
    $masihDipakai = PembimbingPeserta::where('id_pembimbing', $id)->exists();

    if ($masihDipakai) {
        return back()->with(
            'error',
            'Pembimbing tidak bisa dihapus karena masih ditugaskan ke peserta aktif.'
        );
    }

    $pembimbing->delete();

    return back()->with('success', 'Data pembimbing lapangan berhasil dihapus');
}

public function storePembimbingAsal(Request $request)
{
    $request->validate([
        'nama' => 'required',
        'id_sekolah_kampus' => 'required|exists:sekolah_kampus,id_sekolah_kampus',
        'no_telp' => 'required',
        'username' => 'required|unique:pembimbing_asal,username',
        'password' => 'required|min:5'
    ]);

    PembimbingAsal::create([
        'id_role' => 3,
        'nama' => $request->nama,
        'id_sekolah_kampus' => $request->id_sekolah_kampus,
        'no_telp' => $request->no_telp,
        'username' => $request->username,
        'password' => Hash::make($request->password)
    ]);

    return back()->with(
        'success',
        'Pembimbing sekolah/kampus berhasil ditambahkan'
    );
}

public function updatePembimbingAsal(Request $request, $id)
{
    $request->validate([
        'nama' => 'required',
        'id_sekolah_kampus' => 'required|exists:sekolah_kampus,id_sekolah_kampus',
        'no_telp' => 'required',
        'username' => 'required|unique:pembimbing_asal,username,' . $id . ',id_pembimbing_asal',
        'password' => 'nullable|min:5'
    ]);

    $pembimbing = PembimbingAsal::findOrFail($id);

    $data = [
        'nama' => $request->nama,
        'id_sekolah_kampus' => $request->id_sekolah_kampus,
        'no_telp' => $request->no_telp,
        'username' => $request->username,
    ];

    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    $pembimbing->update($data);

    return back()->with(
        'success',
        'Pembimbing sekolah/kampus berhasil diupdate'
    );
}

public function deletePembimbingAsal($id)
{
    $pembimbing = PembimbingAsal::findOrFail($id);

    // cegah hapus kalau masih jadi pembimbing asal aktif peserta
    $masihDipakai = \App\Models\PembimbingAsalPeserta::where('id_pembimbing_asal', $id)->exists();

    if ($masihDipakai) {
        return back()->with(
            'error',
            'Pembimbing sekolah/kampus tidak bisa dihapus karena masih ditugaskan ke peserta aktif.'
        );
    }

    $pembimbing->delete();

    return back()->with(
        'success',
        'Data pembimbing sekolah/kampus berhasil dihapus'
    );
}

public function assignPembimbingAsal(Request $request, $id)
{
    $request->validate([
        'id_pembimbing_asal' =>
            'required|exists:pembimbing_asal,id_pembimbing_asal'
    ]);

    \App\Models\PembimbingAsalPeserta::updateOrCreate(
        ['id_peserta' => $id],
        [
            'id_pembimbing_asal' =>
                $request->id_pembimbing_asal
        ]
    );

    return back()->with(
        'success',
        'Pembimbing asal berhasil ditentukan'
    );
}


public function updateDataPeserta(Request $request, $id)
{
    $request->validate([
        'nama' => 'required|string|max:100',
        'nisn_nim' => 'required|max:11|unique:peserta,nisn_nim,' . $id . ',id_peserta',
        'id_jurusan' => 'nullable|exists:jurusan,id_jurusan',
        'id_sekolah_kampus' => 'nullable|exists:sekolah_kampus,id_sekolah_kampus',
        'kelas' => 'nullable|string|max:2',
        'semester' => 'required|integer|min:1|max:14',
        'awal_magang' => 'required|date',
        'akhir_magang' => 'required|date|after_or_equal:awal_magang',
    ], [
        'nisn_nim.max' => 'NISN/NIM maksimal 11 karakter',
        'nisn_nim.unique' => 'NISN/NIM ini sudah terdaftar pada peserta lain.',
        'akhir_magang.after_or_equal' => 'Tanggal akhir magang tidak boleh sebelum tanggal awal.',
    ]);

    $peserta = Peserta::findOrFail($id);

    $peserta->update([
        'nama' => $request->nama,
        'nisn_nim' => $request->nisn_nim,
        'id_jurusan' => $request->id_jurusan,
        'id_sekolah_kampus' => $request->id_sekolah_kampus,
        'kelas' => $request->kelas,
        'semester' => $request->semester,
        'awal_magang' => $request->awal_magang,
        'akhir_magang' => $request->akhir_magang,
    ]);

    if ($request->expectsJson()) {
        return response()->json([
            'success' => true,
            'message' => 'Data peserta berhasil diperbarui.',
            'data' => [
                'nama' => $peserta->nama,
                'nisn_nim' => $peserta->nisn_nim,
                'jurusan' => optional($peserta->jurusan)->jurusan ?? '-',
                'sekolah_kampus' => optional($peserta->sekolahKampus)->nama_sekolah_kampus ?? '-',
                'kelas' => $peserta->kelas,
                'semester' => $peserta->semester,
                'awal_magang' => \Carbon\Carbon::parse($peserta->awal_magang)->format('d-m-Y'),
                'akhir_magang' => \Carbon\Carbon::parse($peserta->akhir_magang)->format('d-m-Y'),
            ],
        ]);
    }

    return back()->with('success', 'Data peserta berhasil diperbarui.');
}

}
