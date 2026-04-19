<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Peserta extends Authenticatable
{
    protected $table = 'peserta';
    protected $primaryKey = 'id_peserta';

    protected $fillable = [
        'id_periode',
        'nama',
        'sekolah',
        'bidang_jurusan',
        'nisn',
        'semester',
        'awal_magang',
        'akhir_magang',
        'no_telp',
        'alamat',
        'kelas',
        'password',
        'email',
        'jenis_kelamin'
    ];

    protected $hidden = [
        'password',
    ];

    public function getAuthIdentifierName()
{
    return 'nisn';
}


    public function berkas()
    {
        return $this->hasMany(BerkasMagang::class, 'id_peserta');
    }

    public function hasilPendaftaran()
    {
        return $this->hasOne(HasilPendaftaran::class, 'id_peserta');
    }

    public function logbook()
    {
        return $this->hasMany(Logbook::class, 'id_peserta');
    }

    public function presensiPeserta()
    {
        return $this->hasMany(PresensiPeserta::class, 'id_peserta');
    }

    public function penilaian()
    {
        return $this->hasMany(PenilaianPeserta::class, 'id_peserta');
    }

    public function pembimbing()
    {
        return $this->belongsToMany(
            Pembimbing::class,
            'pembimbing_peserta',
            'id_peserta',
            'id_pembimbing'
        );
    }
}
