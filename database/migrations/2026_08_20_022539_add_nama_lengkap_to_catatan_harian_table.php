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
        // Cek apakah tabel catatan_harian ada
        if (Schema::hasTable('catatan_harian')) {
            Schema::table('catatan_harian', function (Blueprint $table) {
                // Cek apakah kolom nama_lengkap sudah ada
                if (!Schema::hasColumn('catatan_harian', 'nama_lengkap')) {
                    $table->string('nama_lengkap', 255)->nullable()->after('user_id');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('catatan_harian')) {
            Schema::table('catatan_harian', function (Blueprint $table) {
                if (Schema::hasColumn('catatan_harian', 'nama_lengkap')) {
                    $table->dropColumn('nama_lengkap');
                }
            });
        }
    }
};