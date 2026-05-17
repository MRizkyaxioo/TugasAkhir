<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = 'jurusan';

    protected $primaryKey = 'id_jurusan';

    protected $fillable = [
        'jurusan'
    ];

    public function peserta()
    {
        return $this->hasMany(Peserta::class, 'id_jurusan');
    }
}
