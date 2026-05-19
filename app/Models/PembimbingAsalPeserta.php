<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PembimbingAsalPeserta extends Model
{
    protected $table = 'pembimbing_asal_peserta';

    protected $primaryKey = 'id_pembimbing_asal_peserta';

    protected $fillable = [
        'id_peserta',
        'id_pembimbing_asal'
    ];

    public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'id_peserta');
    }

    public function pembimbingAsal()
    {
        return $this->belongsTo(
            PembimbingAsal::class,
            'id_pembimbing_asal'
        );
    }
}
