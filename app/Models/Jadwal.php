<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';

    protected $fillable = [
        'guru_id',
        'mata_pelajaran_id',
        'tahun_akademik_id',
        'jurusan_id',
        'kelas_id',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'status',
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id');
    }

    public function tahunAkademik()
    {
        return $this->belongsTo(TahunAkademik::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function getJurusanByTahunAkademikAndIdGuru($idTahunAkademik, $idGuru)
    {
        return self::where('tahun_akademik_id', $idTahunAkademik)
            ->where('guru_id', $idGuru)
            ->with('jurusan')
            ->get()
            ->pluck('jurusan')
            ->unique('id')
            ->values();
    }

    public function getKelasByTahunAkemikAndJurusanAndIdGuru($idTahunAkademik, $jurusan, $idGuru)
    {
        return self::where('tahun_akademik_id', $idTahunAkademik)
            ->where('jurusan_id', $jurusan)
            ->where('guru_id', $idGuru)
            ->with('kelas')
            ->get()
            ->pluck('kelas')
            ->unique('id')
            ->values();
    }
}
