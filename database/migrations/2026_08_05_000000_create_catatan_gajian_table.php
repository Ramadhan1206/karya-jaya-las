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
        // Cek apakah tabel sudah ada
        if (!Schema::hasTable('catatan_gajian')) {
            Schema::create('catatan_gajian', function (Blueprint $table) {
                $table->id();
                
                // ===== FOREIGN KEYS =====
                $table->foreignId('user_id')
                      ->constrained('users')
                      ->onDelete('cascade')
                      ->onUpdate('cascade');
                
                $table->foreignId('catatan_harian_id')
                      ->nullable()
                      ->constrained('catatan_harian')
                      ->onDelete('set null')
                      ->onUpdate('cascade');
                
                // ===== INFORMASI GAJIAN =====
                $table->date('tanggal_gaji');
                $table->string('periode', 50)->nullable();
                $table->enum('jenis_gaji', ['harian', 'mingguan', 'bulanan'])
                      ->default('harian');
                
                // ===== KOMPONEN GAJI =====
                $table->decimal('gaji_pokok', 15, 2)->default(0);
                $table->decimal('tunjangan', 15, 2)->default(0);
                $table->decimal('bonus', 15, 2)->default(0);
                $table->decimal('potongan', 15, 2)->default(0);
                $table->decimal('total_gaji', 15, 2)->default(0);
                
                // ===== REKAP ABSEN =====
                $table->integer('total_hadir')->default(0);
                $table->integer('total_izin')->default(0);
                $table->integer('total_sakit')->default(0);
                $table->integer('total_alpha')->default(0);
                $table->integer('total_lembur')->default(0);
                
                // ===== DETAIL =====
                $table->text('keterangan')->nullable();
                $table->text('rincian_pekerjaan')->nullable();
                
                // ===== STATUS =====
                $table->enum('status', ['draft', 'proses', 'dibayar', 'batal'])
                      ->default('draft');
                
                // ===== TIMESTAMPS =====
                $table->timestamps();
                
                // ===== INDEX =====
                $table->index('user_id');
                $table->index('tanggal_gaji');
                $table->index('periode');
                $table->index('status');
                $table->index(['user_id', 'tanggal_gaji']);
                $table->index(['user_id', 'periode']);
            });
        } else {
            // ===== TAMBAHKAN KOLOM YANG HILANG (JIKA ADA) =====
            Schema::table('catatan_gajian', function (Blueprint $table) {
                // Cek dan tambahkan kolom total_izin jika belum ada
                if (!Schema::hasColumn('catatan_gajian', 'total_izin')) {
                    $table->integer('total_izin')->default(0);
                }
                
                // Cek dan tambahkan kolom total_alpha jika belum ada
                if (!Schema::hasColumn('catatan_gajian', 'total_alpha')) {
                    $table->integer('total_alpha')->default(0);
                }
                
                // Cek dan tambahkan kolom total_lembur jika belum ada
                if (!Schema::hasColumn('catatan_gajian', 'total_lembur')) {
                    $table->integer('total_lembur')->default(0);
                }
                
                // Cek dan tambahkan kolom rincian_pekerjaan jika belum ada
                if (!Schema::hasColumn('catatan_gajian', 'rincian_pekerjaan')) {
                    $table->text('rincian_pekerjaan')->nullable();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catatan_gajian');
    }
};  