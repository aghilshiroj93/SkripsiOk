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
        Schema::table('absensi', function (Blueprint $table) {
            $table->boolean('notifikasi_terkirim')->default(false);
        });
    }

    public function down()
    {
        Schema::table('absensi', function (Blueprint $table) {
            $table->dropColumn('notifikasi_terkirim');
        });
    }
};
