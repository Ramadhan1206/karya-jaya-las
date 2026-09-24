<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('catatan_harian', function (Blueprint $table) {
            $table->enum('durasi', ['full', 'half'])->default('full')->after('jam_pulang');
        });
    }

    public function down()
    {
        Schema::table('catatan_harian', function (Blueprint $table) {
            $table->dropColumn('durasi');
        });
    }
};