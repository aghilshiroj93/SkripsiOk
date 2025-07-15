<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
     protected $fillable = ['nama_kelas'];

     public function details()
     {
          return $this->hasMany(Detail::class, 'kelas_id', 'id');
     }
     public function jadwal()
     {
          return $this->hasMany(Jadwal::class);
     }
     public function jurusan()
     {
          return $this->belongsTo(Jurusan::class);
     }
}
