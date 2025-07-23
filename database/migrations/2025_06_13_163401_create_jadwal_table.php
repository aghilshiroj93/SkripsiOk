<?php

use Illuminate\Database\Migrations\Migration;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalTable extends Migration
{
    public function up()
    {
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guru_id')->constrained('guru')->onDelete('cascade');
            $table->foreignId('mata_pelajaran_id')->constrained('mata_pelajaran')->onDelete('cascade');
            $table->foreignId('tahun_akademik_id')->constrained('tahun_akademik')->onDelete('cascade');
            $table->foreignId('jurusan_id')->constrained('jurusan')->onDelete('cascade');
            $table->foreignId('kelas_id')->constrained('kelas')->onDelete('cascade');
            $table->enum('hari', [
                'Senin',
                'Selasa',
                'Rabu',
                'Kamis',
                'Jumat',
                'Sabtu',
                'Minggu'
            ]);
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jadwal');
    }
}
