<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pembimbing extends Authenticatable
{
    protected $table = 'pembimbing_lapangan';
    protected $primaryKey = 'id_pembimbing';

    protected $fillable = [
        'id_role',
        'nama',
        'nip_nidn',
        'password',
        'username'
    ];

    protected $hidden = [
        'password',
    ];

    public function role()
    {
        return $this->belongsTo(RoleKhusus::class, 'id_role');
    }

    public function peserta()
    {
        return $this->belongsToMany(
            Peserta::class,
            'pembimbing_peserta',
            'id_pembimbing',
            'id_peserta'
        );
    }
}
