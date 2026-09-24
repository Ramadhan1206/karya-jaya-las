<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Tambahkan kolom baru
            $table->string('sku', 50)->nullable()->after('id');
            $table->string('weight', 50)->nullable()->after('price');
            $table->string('dimensions', 100)->nullable()->after('weight');
            
            // Tambah index
            $table->index('sku');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['sku', 'weight', 'dimensions']);
        });
    }
};