<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Siswa extends Authenticatable
{
    protected $table = 'siswa';
    protected $hidden = ['password'];
    protected $fillable = [
        'nis',
        'nisn',
        'nama',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'no_hp',
        'password'
    ];

    public function details()
    {
        return $this->hasMany(Detail::class, 'siswa_id', 'id');
    }
    public function detail()
    {
        return $this->hasOne(Detail::class, 'siswa_id', 'id')->with(['kelas', 'jurusan']);
    }

    public function getAuthIdentifierName()
    {
        return 'nis';
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function siswaTidakAktif()
    {
        return $this->hasOne(SiswaTidakAktif::class);
    }
}
