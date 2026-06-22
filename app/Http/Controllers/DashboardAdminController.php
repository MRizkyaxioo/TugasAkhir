<?php

namespace App\Http\Controllers;

use App\Mail\PesertaDiterimaMail;
use App\Mail\PesertaDitolakMail;
use App\Models\KuotaMagang;
use App\Models\Peserta;
use App\Models\HasilPendaftaran;
use App\Models\Logbook;
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

    return view(
        'admin.detailpeserta',
        compact('peserta', 'pembimbing', 'pembimbingAsal')
    );
}

// 🔹 Detail riwayat
    public function detailPesertaSelesai($id)
    {
        $peserta = Peserta::with('hasilPendaftaran.berkas', 'jurusan',
        'sekolahKampus')
            ->findOrFail($id);

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

    return view('admin.pembimbing', compact(
        'data',
        'pembimbingAsal',
        'sekolah'
    ));
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

public function jurusan()
{
    $data = Jurusan::all();

    return view('admin.jurusan', compact('data'));
}

public function storeJurusan(Request $request)
{
    $request->validate([
        'jurusan' => 'required'
    ]);

    Jurusan::create([
        'jurusan' => $request->jurusan
    ]);

    return back()->with('success', 'Jurusan berhasil ditambahkan');
}

public function sekolah()
{
    $data = SekolahKampus::all();

    return view('admin.sekolah', compact('data'));
}

public function storeSekolahKampus(Request $request)
{
    $request->validate([
        'nama_sekolah_kampus' => 'required'
    ]);

    SekolahKampus::create([
        'nama_sekolah_kampus' => $request->nama_sekolah_kampus
    ]);

    return back()->with('success', 'Sekolah/Kampus berhasil ditambahkan');
}

public function updateJurusan(Request $request, $id)
{
    $request->validate([
        'jurusan' => 'required'
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
        'nama_sekolah_kampus' => 'required'
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

}
