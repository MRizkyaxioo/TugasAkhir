<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KriteriaNilai extends Model
{
     protected $table = 'kriteria_nilai';
    protected $primaryKey = 'id_kriteria_nilai';

    protected $fillable = [
        'kriteria_nilai'
    ];

    public function penilaian()
    {
        return $this->hasMany(PenilaianPeserta::class, 'id_kriteria_nilai');
    }
}
