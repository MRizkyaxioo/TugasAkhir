<?php

namespace App\Http\Controllers;

use App\Models\KriteriaNilai;
use App\Models\PenilaianPeserta;
use App\Models\Peserta;
use App\Models\KepalaPerpustakaan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    // 🔹 FORM PENILAIAN
    public function form($id)
{
    $peserta = Peserta::with('penilaian.kriteria')->findOrFail($id);

    $kriteria = KriteriaNilai::all();

    // ambil nilai lama peserta
    $nilaiLama = PenilaianPeserta::where('id_peserta', $id)
        ->get()
        ->keyBy('id_kriteria_nilai');

    return view('pembimbing.penilaian', compact(
        'peserta',
        'kriteria',
        'nilaiLama'
    ));
}

    // 🔹 SIMPAN NILAI
    public function simpan(Request $request, $id)
{
    $request->validate([
        'kriteria_id' => 'required|exists:kriteria_nilai,id_kriteria_nilai',
        'nilai' => 'required|integer|min:1|max:100'
    ]);

    PenilaianPeserta::updateOrCreate(
        [
            'id_peserta' => $id,
            'id_kriteria_nilai' => $request->kriteria_id
        ],
        [
            'nilai' => $request->nilai
        ]
    );

    return back()->with('success', 'Nilai berhasil disimpan');
}

    // 🔹 CRUD KRITERIA
    public function storeKriteria(Request $request)
{
    $request->validate([
        'kriteria' => 'required|string|max:100|unique:kriteria_nilai,kriteria_nilai'
    ], [
        'kriteria.required' => 'Kriteria wajib diisi.',
        'kriteria.unique' => 'Kriteria penilaian ini sudah ada.',
    ]);

    KriteriaNilai::create([
        'kriteria_nilai' => $request->kriteria
    ]);

    return back()->with('success', 'Kriteria berhasil ditambahkan');
}

    public function deleteKriteria($id)
{
    $kriteria = KriteriaNilai::findOrFail($id);
    // Hapus semua nilai yang menggunakan kriteria ini
    PenilaianPeserta::where('id_kriteria_nilai', $id)->delete();
    $kriteria->delete();

    return back()->with('success', 'Kriteria dan semua nilai terkait berhasil dihapus.');
}

public function updateKriteria(Request $request, $id)
{
    $request->validate([
        'kriteria' => 'required|string|max:100|unique:kriteria_nilai,kriteria_nilai,' . $id . ',id_kriteria_nilai'
    ], [
        'kriteria.required' => 'Kriteria wajib diisi.',
        'kriteria.unique' => 'Kriteria penilaian ini sudah ada.',
    ]);

    KriteriaNilai::where('id_kriteria_nilai', $id)
        ->update(['kriteria_nilai' => $request->kriteria]);

    return back()->with('success', 'Kriteria berhasil diupdate');
}

public function hapusNilai($id_peserta, $id_kriteria)
{
    // Pastikan peserta dan kriteria valid
    PenilaianPeserta::where('id_peserta', $id_peserta)
        ->where('id_kriteria_nilai', $id_kriteria)
        ->delete();

    return back()->with('success', 'Nilai berhasil dihapus.');
}

    public function exportNilai($id)
{
    $pesertaLogin = auth()->guard('peserta')->user();
    $adminLogin = auth()->guard('admin')->user();
    $pembimbingLogin = auth()->guard('pembimbing')->user();

    // 🔥 kalau tidak login sama sekali
    if (!$pesertaLogin && !$adminLogin && !$pembimbingLogin) {
        abort(403);
    }

    // 🔥 kalau peserta → hanya boleh akses miliknya sendiri
    if ($pesertaLogin && $pesertaLogin->id_peserta != $id) {
        abort(403);
    }

    $peserta = Peserta::with([
    'penilaian.kriteria',
    'pembimbing'
])->findOrFail($id);

    $kepala = KepalaPerpustakaan::first();

    $pdf = Pdf::loadView('peserta.nilai_pdf', compact('peserta', 'kepala'));

    return $pdf->download('nilai_'.$peserta->nama.'.pdf');
}

public function assignKriteria(Request $request, $id)
{
    $request->validate([
        'kriteria' => 'required|array'
    ]);

    $peserta = Peserta::findOrFail($id);

    // sync tanpa hapus yang lama
    $peserta->kriteriaDipakai()->syncWithoutDetaching($request->kriteria);

    return back()->with('success', 'Kriteria berhasil dipilih');
}
}
