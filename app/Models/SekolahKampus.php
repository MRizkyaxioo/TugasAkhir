<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SekolahKampus extends Model
{
    protected $table = 'sekolah_kampus';

    protected $primaryKey = 'id_sekolah_kampus';

    protected $fillable = [
        'nama_sekolah_kampus'
    ];

    public function peserta()
    {
        return $this->hasMany(Peserta::class, 'id_sekolah_kampus');
    }
}
