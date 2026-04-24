<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogbookController extends Controller
{
    // 🔹 HALAMAN LOGBOOK PESERTA
    public function index()
    {
        $peserta = Auth::guard('peserta')->user();

        $data = Logbook::where('id_peserta', $peserta->id_peserta)
            ->latest()
            ->get();

        return view('peserta.logbook', compact('data'));
    }

    // 🔹 SIMPAN LOGBOOK
    public function store(Request $request)
    {
        $peserta = Auth::guard('peserta')->user();

        $request->validate([
            'tanggal' => 'required|date',
            'kegiatan' => 'required',
            'bukti_foto' => 'nullable|image|max:2048'
        ]);

        $path = null;

        if ($request->hasFile('bukti_foto')) {
            $file = $request->file('bukti_foto');
            $filename = time().'_'.$file->getClientOriginalName();
            $path = $file->storeAs('logbook', $filename, 'public');
        }

        Logbook::create([
            'id_peserta' => $peserta->id_peserta,
            'tanggal' => $request->tanggal,
            'kegiatan' => $request->kegiatan,
            'bukti_foto' => $path
        ]);

        return back()->with('success', 'Logbook berhasil disimpan');
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
