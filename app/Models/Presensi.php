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
        'status',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function presensiPeserta()
    {
        return $this->hasMany(PresensiPeserta::class, 'id_presensi');
    }
}
