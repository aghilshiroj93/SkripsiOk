<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'absensi';
    protected $fillable = [
        'jadwal_id',
        'siswa_id',
        'guru_id',
        'status',
        'waktu_absen',
        'notifikasi_terkirim'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
    public function detail()
    {
        return $this->belongsTo(Detail::class);
    }
}
