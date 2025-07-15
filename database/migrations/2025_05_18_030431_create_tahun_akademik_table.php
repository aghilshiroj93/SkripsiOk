<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
     public function up()
    {
        Schema::create('tahun_akademik', function (Blueprint $table) {
            $table->id();
            $table->string('tahun'); // Misalnya: 2024/2025
            $table->enum('semester', ['ganjil', 'genap']);
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tahun_akademik');
    }
};
