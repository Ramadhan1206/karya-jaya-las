<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('catatan_harian', function (Blueprint $table) {
            if (!Schema::hasColumn('catatan_harian', 'tipe_kerja')) {
                $table->string('tipe_kerja', 50)->nullable()->after('status');
            }
        });
    }

    public function down()
    {
        Schema::table('catatan_harian', function (Blueprint $table) {
            if (Schema::hasColumn('catatan_harian', 'tipe_kerja')) {
                $table->dropColumn('tipe_kerja');
            }
        });
    }
};