<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KuotaMagang extends Model
{
    protected $table = 'kuota_magang';
    protected $primaryKey = 'id_kuota';

    protected $fillable = [
        'kuota_peserta'
    ];

    public $timestamps = true;
}
