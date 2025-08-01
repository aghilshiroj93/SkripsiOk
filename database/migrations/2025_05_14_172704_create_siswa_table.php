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
        Schema::create('siswa', function (Blueprint $table) {
            $table->id(); // Bisa jadi ID auto increment, meskipun ada NIS, ini untuk kemudahan Laravel
            $table->bigInteger('nis')->unsigned()->unique();
            $table->string('nisn', 20);
            $table->string('nama', 100);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('tempat_lahir', 50);
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->string('no_hp', 15);
            $table->timestamps();
            $table->softDeletes(); // Untuk mengaktifkan soft delete
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
