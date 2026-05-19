<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class PembimbingAsal extends Authenticatable
{
    protected $table = 'pembimbing_asal';

    protected $primaryKey = 'id_pembimbing_asal';

    protected $fillable = [
        'id_role',
        'nama',
        'id_sekolah_kampus',
        'no_telp',
        'username',
        'password'
    ];

    protected $hidden = [
        'password'
    ];

    public function peserta()
    {
        return $this->belongsToMany(
            Peserta::class,
            'pembimbing_asal_peserta',
            'id_pembimbing_asal',
            'id_peserta'
        );
    }

    public function role()
    {
        return $this->belongsTo(RoleKhusus::class, 'id_role');
    }

    public function getAuthIdentifierName()
    {
        return 'username';
    }

    public function sekolahKampus()
{
    return $this->belongsTo(
        SekolahKampus::class,
        'id_sekolah_kampus',
        'id_sekolah_kampus'
    );
}
}
