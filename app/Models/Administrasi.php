<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Administrasi extends Authenticatable
{
    protected $table = 'administrasi';
    protected $primaryKey = 'id_administrasi';

    protected $fillable = [
        'id_role',
        'username',
        'password'
    ];

    protected $hidden = [
        'password',
    ];

    public function getAuthIdentifierName()
{
    return 'username';
}

    public function role()
    {
        return $this->belongsTo(RoleKhusus::class, 'id_role');
    }
}
