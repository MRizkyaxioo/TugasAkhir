<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PembimbingPeserta extends Model
{
    protected $table = 'pembimbing_peserta';
    protected $primaryKey = 'id_pembimbing_peserta';

    protected $fillable = [
        'id_peserta',
        'id_pembimbing'
    ];

    public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'id_peserta');
    }

    public function pembimbing()
    {
        return $this->belongsTo(Pembimbing::class, 'id_pembimbing');
    }
}
