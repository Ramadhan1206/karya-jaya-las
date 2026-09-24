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
        Schema::table('catatan_harian', function (Blueprint $table) {
            // Cek apakah kolom sudah ada sebelum menambahkan
            if (!Schema::hasColumn('catatan_harian', 'durasi_kerja')) {
                $table->integer('durasi_kerja')->nullable()->after('jam_pulang');
            }
            
            // Tambahkan kolom lain jika diperlukan
            if (!Schema::hasColumn('catatan_harian', 'total_lembur')) {
                $table->integer('total_lembur')->default(0)->after('durasi_kerja');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('catatan_harian', function (Blueprint $table) {
            $table->dropColumn([
                'durasi_kerja',
                'total_lembur'
            ]);
        });
    }
};