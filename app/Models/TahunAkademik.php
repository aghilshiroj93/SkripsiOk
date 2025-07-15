<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAkademik extends Model
{
    use HasFactory;

    protected $table = 'tahun_akademik'; // TANPA 's'

    protected $fillable = [
        'tahun',
        'semester',
        'is_active',
    ];


    public function detail()
    {
        return $this->hasMany(Detail::class, 'tahun_akademik_id', 'id');
    }
}
