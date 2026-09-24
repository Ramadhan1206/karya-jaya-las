<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ResetUsersSeeder extends Seeder
{
    public function run()
    {
        // Nonaktifkan foreign key
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        
        // Hapus semua user
        User::truncate();
        
        // Aktifkan kembali
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        
        $this->command->info('✅ All users deleted!');
    }
}