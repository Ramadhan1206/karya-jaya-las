<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Mesin Las Listrik (SMAW)',
                'description' => 'Mesin las listrik untuk pengelasan SMAW (Shielded Metal Arc Welding)',
                'icon' => 'fa-bolt'
            ],
            [
                'name' => 'Mesin Las TIG (GTAW)',
                'description' => 'Mesin las TIG untuk pengelasan presisi GTAW (Gas Tungsten Arc Welding)',
                'icon' => 'fa-fire'
            ],
            [
                'name' => 'Mesin Las MIG (GMAW)',
                'description' => 'Mesin las MIG untuk pengelasan otomatis GMAW (Gas Metal Arc Welding)',
                'icon' => 'fa-wind'
            ],
            [
                'name' => 'Mesin Las Gas (OAW)',
                'description' => 'Mesin las gas untuk pengelasan OAW (Oxy-Acetylene Welding)',
                'icon' => 'fa-gas-pump'
            ],
            [
                'name' => 'Elektroda Las',
                'description' => 'Berbagai jenis elektroda untuk pengelasan',
                'icon' => 'fa-rod-snake'
            ],
            [
                'name' => 'Kawat Las',
                'description' => 'Kawat las untuk berbagai jenis pengelasan',
                'icon' => 'fa-wire'
            ],
            [
                'name' => 'Aksesoris Las',
                'description' => 'Aksesoris pendukung pengelasan',
                'icon' => 'fa-tools'
            ],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }
    }
}