<?php

namespace App\Exports;

use App\Models\PresensiPeserta;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RekapPresensiExport implements FromCollection, WithHeadings
{
    protected $bulan;
    protected $nama;
    protected $tanggal;

    public function __construct($bulan = null, $tanggal = null, $nama = null)
    {
        $this->bulan = $bulan;
        $this->tanggal  = $tanggal;
        $this->nama  = $nama;
    }

    public function collection()
    {
        $query = PresensiPeserta::select(
            'id_peserta',
            DB::raw("SUM(status_kehadiran='hadir') as hadir"),
            DB::raw("SUM(status_kehadiran='izin') as izin"),
            DB::raw("SUM(status_kehadiran='sakit') as sakit"),
            DB::raw("SUM(status_kehadiran='alpa') as alpa")
        )
        ->with('peserta')
        ->where('is_final', 1)
        ->whereHas('peserta.hasilPendaftaran', function ($q) {
            $q->where('status', 'diterima');
        });

        // FILTER BULAN
if ($this->bulan) {
    $query->whereMonth('tanggal_presensi', $this->bulan);
}

// FILTER TANGGAL
if ($this->tanggal) {
    $query->whereDate('tanggal_presensi', $this->tanggal);
}

// FILTER NAMA
if ($this->nama) {
    $query->whereHas('peserta', function ($q) {
        $q->where('nama', 'like', '%' . $this->nama . '%');
    });
}

        $data = $query->groupBy('id_peserta')->get();

        return $data->map(function ($item) {
            return [
                'NISN/NIM' => $item->peserta->nisn_nim ?? '-',
                'Nama'     => $item->peserta->nama ?? '-',
                'Hadir'    => $item->hadir,
                'Izin'     => $item->izin,
                'Sakit'    => $item->sakit,
                'Alpa'     => $item->alpa,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'NISN/NIM',
            'Nama',
            'Hadir',
            'Izin',
            'Sakit',
            'Alpa',
        ];
    }
}
