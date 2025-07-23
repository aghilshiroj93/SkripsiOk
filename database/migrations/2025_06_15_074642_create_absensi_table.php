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
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jadwal_id')->constrained('jadwal')->onDelete('cascade');
            $table->foreignId('siswa_id')->constrained('siswa')->onDelete('cascade');
            $table->foreignId('guru_id')->constrained('guru')->onDelete('cascade');
            $table->enum('status', ['H', 'I', 'S', 'A'])->default('A');
            $table->timestamp('waktu_absen')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};
