<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KepalaPerpustakaan extends Model
{
    protected $table = 'kepala_perpustakaan';
    protected $primaryKey = 'id_kepala';

    protected $fillable = [
        'nama',
    ];
}
