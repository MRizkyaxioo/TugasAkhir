<?php

namespace App\Http\Controllers;

use App\Models\KuotaMagang;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
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
}
