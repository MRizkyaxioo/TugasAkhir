<?php

namespace App\Http\Controllers;

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
    $peserta = Auth::guard('peserta')->user();
    return view('peserta.dashboard', compact('peserta'));
}
}
