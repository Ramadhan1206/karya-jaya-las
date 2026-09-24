<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('foto_proyek', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proyek_id')->constrained('proyek')->onDelete('cascade');
            $table->string('foto_url');
            $table->string('judul')->nullable();
            $table->text('keterangan')->nullable();
            $table->boolean('is_cover')->default(false);
            $table->integer('urutan')->default(0);
            $table->timestamps();
            
            $table->index('proyek_id');
            $table->index('is_cover');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('foto_proyek');
    }
};