<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaTidakAktif extends Model
{
    use HasFactory;

    protected $table = 'siswa_tidak_aktif';

    protected $fillable = ['siswa_id'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
