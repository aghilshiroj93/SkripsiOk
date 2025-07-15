<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Detail extends Model
{
    protected $table = 'detail';
    protected $primaryKey = 'id_detail';
    use HasFactory;

    protected $fillable = [
        'kelas_id',
        'tahun_akademik_id',
        'jurusan_id',
        'siswa_id',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }

    public function tahunAkademik()
    {
        return $this->belongsTo(TahunAkademik::class, 'tahun_akademik_id', 'id');
    }


    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id', 'id');
    }
    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class);
    }



    public function getPembagianKelas()
    {
        return self::join('kelas', 'detail.kelas_id', '=', 'kelas.id')
            ->join('jurusan', 'detail.jurusan_id', '=', 'jurusan.id')
            ->join('tahun_akademik', 'detail.tahun_akademik_id', '=', 'tahun_akademik.id')
            ->where('tahun_akademik.is_active', 1)
            ->select(
                DB::raw('MIN(detail.id_detail) as id_detail'),
                'kelas.nama_kelas',
                'jurusan.nama',
                'tahun_akademik.tahun'
            )
            ->groupBy('kelas.nama_kelas', 'jurusan.nama', 'tahun_akademik.tahun')
            ->get();
    }

  
}
