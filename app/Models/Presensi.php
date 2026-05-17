<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    protected $table = 'presensi';
    protected $primaryKey = 'id_presensi';

    protected $fillable = [
        'tanggal',
        'jam_buka',
        'jam_tutup',
        'is_open',
        'opened_at',
        'closed_at'
    ];

    public function presensiPeserta()
    {
        return $this->hasMany(PresensiPeserta::class, 'id_presensi');
    }
}
