<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = 'jurusan';
    protected $fillable = ['nama'];


    public function details()
    {
        return $this->hasMany(Detail::class, 'jurusan_id', 'id');
    }
}
