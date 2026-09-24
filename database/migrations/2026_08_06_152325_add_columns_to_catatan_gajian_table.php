<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Cek apakah tabel catatan_gajian ada
        if (Schema::hasTable('catatan_gajian')) {
            Schema::table('catatan_gajian', function (Blueprint $table) {
                // Cek apakah kolom sudah ada sebelum menambahkan
                if (!Schema::hasColumn('catatan_gajian', 'nama_lengkap')) {
                    $table->string('nama_lengkap')->nullable()->after('user_id');
                }
                if (!Schema::hasColumn('catatan_gajian', 'total_hadir')) {
                    $table->integer('total_hadir')->default(0)->after('total_gaji');
                }
                if (!Schema::hasColumn('catatan_gajian', 'total_izin')) {
                    $table->integer('total_izin')->default(0)->after('total_hadir');
                }
                if (!Schema::hasColumn('catatan_gajian', 'total_sakit')) {
                    $table->integer('total_sakit')->default(0)->after('total_izin');
                }
                if (!Schema::hasColumn('catatan_gajian', 'total_alpha')) {
                    $table->integer('total_alpha')->default(0)->after('total_sakit');
                }
                if (!Schema::hasColumn('catatan_gajian', 'total_lembur')) {
                    $table->integer('total_lembur')->default(0)->after('total_alpha');
                }
                if (!Schema::hasColumn('catatan_gajian', 'rincian_pekerjaan')) {
                    $table->text('rincian_pekerjaan')->nullable()->after('keterangan');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('catatan_gajian')) {
            Schema::table('catatan_gajian', function (Blueprint $table) {
                $table->dropColumn([
                    'nama_lengkap', 'total_hadir', 'total_izin', 
                    'total_sakit', 'total_alpha', 'total_lembur', 
                    'rincian_pekerjaan'
                ]);
            });
        }
    }
};