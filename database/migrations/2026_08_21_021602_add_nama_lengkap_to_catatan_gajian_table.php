<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // CEK APAKAH TABEL CATATAN_GAJIAN ADA
        if (Schema::hasTable('catatan_gajian')) {
            Schema::table('catatan_gajian', function (Blueprint $table) {
                if (!Schema::hasColumn('catatan_gajian', 'nama_lengkap')) {
                    $table->string('nama_lengkap')->nullable()->after('user_id');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('catatan_gajian')) {
            if (Schema::hasColumn('catatan_gajian', 'nama_lengkap')) {
                Schema::table('catatan_gajian', function (Blueprint $table) {
                    $table->dropColumn('nama_lengkap');
                });
            }
        }
    }
};