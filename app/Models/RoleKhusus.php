<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleKhusus extends Model
{
    protected $table = 'role_khusus';
    protected $primaryKey = 'id_role';

    protected $fillable = [
        'role'
    ];

    public function pembimbing()
    {
        return $this->hasMany(Pembimbing::class, 'id_role');
    }

    public function administrasi()
    {
        return $this->hasMany(Administrasi::class, 'id_role');
    }
}
