<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PresensiPeserta extends Model
{
    protected $table = 'presensi_peserta';
    protected $primaryKey = 'id_presensi_peserta';

    protected $fillable = [
        'id_peserta',
        'id_presensi',
        'surat_pendukung_izin',
        'tanggal_presensi',
        'status_kehadiran'
    ];

    public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'id_peserta');
    }

    public function presensi()
    {
        return $this->belongsTo(PresensiPeserta::class, 'id_presensi');
    }
}
