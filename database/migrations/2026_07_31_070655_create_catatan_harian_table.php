<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('catatan_harian')) {
            Schema::create('catatan_harian', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->date('tanggal');
                $table->time('jam_masuk')->nullable();
                $table->time('jam_pulang')->nullable();
                $table->string('proyek')->nullable();
                $table->text('pekerjaan')->nullable();
                $table->text('catatan')->nullable();
                $table->enum('status', ['hadir', 'izin', 'sakit', 'alpha'])->default('hadir');
                $table->integer('durasi_kerja')->nullable();
                $table->timestamps();
                
                $table->index(['user_id', 'tanggal']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('catatan_harian');
    }
};