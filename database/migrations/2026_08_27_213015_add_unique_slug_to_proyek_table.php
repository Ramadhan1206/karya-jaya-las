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
        Schema::table('proyek', function (Blueprint $table) {
            // Cek apakah kolom slug ada
            if (Schema::hasColumn('proyek', 'slug')) {
                // Cek apakah unique index sudah ada
                $indexes = \DB::select("SHOW INDEX FROM proyek WHERE Key_name = 'proyek_slug_unique'");
                if (empty($indexes)) {
                    $table->unique('slug');
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proyek', function (Blueprint $table) {
            // Hapus unique index jika ada
            $table->dropUnique(['slug']);
        });
    }
};