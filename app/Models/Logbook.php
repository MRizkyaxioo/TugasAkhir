<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    protected $table = 'logbook';
    protected $primaryKey = 'id_logbook';

    protected $fillable = [
        'id_peserta',
        'tanggal',
        'kegiatan',
        'bukti_foto'
    ];

    public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'id_peserta');
    }
}
