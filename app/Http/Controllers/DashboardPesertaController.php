<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardPesertaController extends Controller
{
    public function calon()
{
    $peserta = Auth::guard('peserta')->user();
    return view('peserta.calon', compact('peserta'));
}


public function peserta()
{
    $user = Auth::guard('peserta')->user();

    $peserta = Peserta::with('hasilPendaftaran')
        ->where('id_peserta', $user->id_peserta)
        ->first();

    return view('peserta.dashboard', compact('peserta'));
}
}
