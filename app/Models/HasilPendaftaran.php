<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilPendaftaran extends Model
{
    protected $table = 'hasil_pendaftaran';
    protected $primaryKey = 'id_hasil';

    protected $fillable = [
        'id_peserta',
        'id_berkas',
        'status',
        'file_berkas_balasan'
    ];

    public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'id_peserta');
    }

    public function berkas()
    {
        return $this->belongsTo(BerkasMagang::class, 'id_berkas');
    }
}
