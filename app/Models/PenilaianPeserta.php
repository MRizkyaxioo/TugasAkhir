<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenilaianPeserta extends Model
{
    protected $table = 'penilaian_peserta';
    protected $primaryKey = 'id_penilaian_peserta';

    protected $fillable = [
        'id_peserta',
        'id_kriteria_nilai',
        'nilai'
    ];

    public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'id_peserta');
    }

    public function kriteria()
    {
        return $this->belongsTo(KriteriaNilai::class, 'id_kriteria_nilai');
    }
}
