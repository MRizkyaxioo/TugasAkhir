<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use App\Models\PresensiPeserta;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class LogbookController extends Controller
{
    public function index()
{
    $peserta = Auth::guard('peserta')->user();
    $today = Carbon::now()->toDateString();

    // Cek apakah peserta sudah presensi hari ini (ada record presensi_peserta dengan tanggal_presensi tidak null)
    $presensiHariIni = PresensiPeserta::where('id_peserta', $peserta->id_peserta)
    ->whereDate('tanggal_presensi', $today)
    ->whereIn('status_kehadiran', ['hadir', 'izin', 'sakit'])
    ->first();

    // Cek apakah logbook hari ini sudah ada
    $logbookHariIni = Logbook::where('id_peserta', $peserta->id_peserta)
        ->whereDate('tanggal', $today)
        ->first();

    // Semua data logbook urut ascending (paling lama di atas)
    $data = Logbook::where('id_peserta', $peserta->id_peserta)
        ->orderBy('tanggal', 'asc')
        ->get();

    // Apakah logbook hari ini bisa diedit?
    $bisaEdit = false;
    if ($logbookHariIni && $presensiHariIni) {
        // Presensi hari ini belum final
        if ($presensiHariIni->is_final == 0) {
            $bisaEdit = true;
        }
    }

    return view('peserta.logbook', compact(
        'data', 'presensiHariIni', 'logbookHariIni', 'bisaEdit'
    ));
}

    public function store(Request $request)
    {
        $peserta = Auth::guard('peserta')->user();
        $today = Carbon::now()->toDateString();

        // Validasi sudah presensi
        $presensi = PresensiPeserta::where('id_peserta', $peserta->id_peserta)
    ->whereDate('tanggal_presensi', $today)
    ->whereIn('status_kehadiran', ['hadir', 'izin', 'sakit'])
    ->first();

        if (!$presensi) {
            return back()->with('error', 'Anda harus melakukan presensi terlebih dahulu.');
        }

        // Validasi belum mengisi logbook hari ini
        $logbookHariIni = Logbook::where('id_peserta', $peserta->id_peserta)
            ->whereDate('tanggal', $today)
            ->first();
        if ($logbookHariIni) {
            return back()->with('error', 'Anda sudah mengisi logbook hari ini.');
        }

        $request->validate([
    'kegiatan' => 'required',
    'bukti_foto' => 'required|mimes:jpeg,png,jpg,heic,heif|max:5120',
], [
    'kegiatan.required' => 'Kegiatan wajib diisi.',
    'bukti_foto.required' => 'Bukti kegiatan wajib diunggah.',
    'bukti_foto.mimes' => 'Format gambar harus JPG, JPEG, PNG, HEIC, atau HEIF.',
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

        Logbook::create([
            'id_peserta' => $peserta->id_peserta,
            'tanggal' => $today,
            'kegiatan' => $request->kegiatan,
            'bukti_foto' => $path
        ]);

        return back()->with('success', 'Logbook berhasil disimpan');
    }

    public function update(Request $request, $id)
{
    $peserta = Auth::guard('peserta')->user();
    $logbook = Logbook::where('id_logbook', $id)
                ->where('id_peserta', $peserta->id_peserta)
                ->firstOrFail();

    $presensi = PresensiPeserta::where('id_peserta', $peserta->id_peserta)
                ->whereDate('tanggal_presensi', $logbook->tanggal)
                ->first();

    if ($presensi && $presensi->is_final == 1) {
        return response()->json(['message' => 'Presensi sudah ditutup, logbook tidak dapat diubah.'], 403);
    }

    $request->validate([
        'kegiatan' => 'required',
        'bukti_foto' => 'nullable|mimes:jpeg,png,jpg,heic,heif|max:5120',
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
        'kegiatan' => $request->kegiatan,
        'bukti_foto' => $path
    ]);

    // Kembalikan respon sukses
    return response()->json(['message' => 'Logbook berhasil diperbarui']);
}

    public function exportPdf()
    {
        $peserta = Auth::guard('peserta')->user();

        if (!$peserta) {
            abort(403);
        }

        $data = Logbook::where('id_peserta', $peserta->id_peserta)
            ->orderBy('tanggal', 'asc')
            ->get();

        $pdf = Pdf::loadView('peserta.logbook_pdf', compact('data', 'peserta'))
            ->setPaper('A4', 'portrait');

        return $pdf->download('logbook_'.$peserta->nama.'.pdf');
    }
}
