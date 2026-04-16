<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BerkasMagang extends Model
{
    protected $table = 'berkas_magang';
    protected $primaryKey = 'id_berkas';

    protected $fillable = [
        'id_peserta',
        'file_berkas'
    ];

    public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'id_peserta');
    }

    public function hasilPendaftaran()
    {
        return $this->hasMany(HasilPendaftaran::class, 'id_berkas');
    }
}
