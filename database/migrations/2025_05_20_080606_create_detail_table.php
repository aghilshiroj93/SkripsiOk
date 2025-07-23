<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail', function (Blueprint $table) {
            $table->id('id_detail');

            $table->bigInteger('kelas_id')->unsigned()->nullable();
            $table->bigInteger('tahun_akademik_id')->unsigned()->nullable();
            $table->bigInteger('jurusan_id')->unsigned()->nullable();
            $table->unsignedBigInteger('siswa_id')->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();

            // Foreign key constraints

            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('set null');
            $table->foreign('tahun_akademik_id')->references('id')->on('tahun_akademik')->onDelete('set null');
            $table->foreign('jurusan_id')->references('id')->on('jurusan')->onDelete('set null');
            $table->foreign('siswa_id')->references('id')->on('siswa')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail', function (Blueprint $table) {
            $table->dropForeign(['siswa_id']);
            $table->dropColumn('siswa_id');
        });
    }
};
