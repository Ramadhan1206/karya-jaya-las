<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $categories = Category::pluck('id', 'name');

        $products = [
            // Mesin Las Listrik (SMAW)
            [
                'category_id' => $categories['Mesin Las Listrik (SMAW)'],
                'name' => 'Mesin Las Inverter 200A',
                'description' => 'Mesin las inverter dengan teknologi IGBT untuk pengelasan SMAW profesional',
                'specifications' => json_encode([
                    'voltage' => '220V',
                    'ampere' => '200A',
                    'duty_cycle' => '60%',
                    'frequency' => '50/60Hz',
                    'material' => 'Besi, Stainless Steel, Aluminium',
                    'weight' => '15 kg',
                    'dimensions' => '45 x 30 x 35 cm'
                ]),
                'brand' => 'Karya Jaya Las',
                'model' => 'KJL-200',
                'price' => 4500000,
                'stock' => 15,
                'unit' => 'unit',
                'warranty' => '1 tahun',
                'featured' => true,
            ],
            [
                'category_id' => $categories['Mesin Las Listrik (SMAW)'],
                'name' => 'Mesin Las Inverter 350A',
                'description' => 'Mesin las inverter heavy duty untuk pengelasan industri',
                'specifications' => json_encode([
                    'voltage' => '380V',
                    'ampere' => '350A',
                    'duty_cycle' => '80%',
                    'frequency' => '50/60Hz',
                    'material' => 'Besi, Stainless Steel, Aluminium',
                    'weight' => '25 kg',
                    'dimensions' => '55 x 40 x 45 cm'
                ]),
                'brand' => 'Karya Jaya Las',
                'model' => 'KJL-350',
                'price' => 7500000,
                'stock' => 8,
                'unit' => 'unit',
                'warranty' => '2 tahun',
                'featured' => true,
            ],
            // Mesin Las TIG
            [
                'category_id' => $categories['Mesin Las TIG (GTAW)'],
                'name' => 'Mesin Las TIG DC Inverter 200A',
                'description' => 'Mesin las TIG untuk pengelasan presisi DC inverter',
                'specifications' => json_encode([
                    'voltage' => '220V',
                    'ampere' => '200A',
                    'duty_cycle' => '60%',
                    'frequency' => '50/60Hz',
                    'material' => 'Stainless Steel, Aluminium, Tembaga',
                    'weight' => '18 kg',
                    'dimensions' => '48 x 32 x 38 cm'
                ]),
                'brand' => 'Karya Jaya Las',
                'model' => 'KJL-TIG200',
                'price' => 5500000,
                'stock' => 10,
                'unit' => 'unit',
                'warranty' => '1 tahun',
                'featured' => false,
            ],
            // Elektroda Las
            [
                'category_id' => $categories['Elektroda Las'],
                'name' => 'Elektroda Las E7018 2.6mm',
                'description' => 'Elektroda las E7018 untuk pengelasan besi dan baja karbon',
                'specifications' => json_encode([
                    'diameter' => '2.6mm',
                    'length' => '350mm',
                    'type' => 'E7018',
                    'material' => 'Besi Karbon',
                    'packaging' => '1kg/boks'
                ]),
                'brand' => 'Karya Jaya Las',
                'model' => 'E7018-26',
                'price' => 25000,
                'stock' => 200,
                'unit' => 'kg',
                'warranty' => null,
                'featured' => false,
            ],
            [
                'category_id' => $categories['Elektroda Las'],
                'name' => 'Elektroda Las E6013 3.2mm',
                'description' => 'Elektroda las E6013 untuk pengelasan serbaguna',
                'specifications' => json_encode([
                    'diameter' => '3.2mm',
                    'length' => '350mm',
                    'type' => 'E6013',
                    'material' => 'Besi Karbon',
                    'packaging' => '1kg/boks'
                ]),
                'brand' => 'Karya Jaya Las',
                'model' => 'E6013-32',
                'price' => 22000,
                'stock' => 300,
                'unit' => 'kg',
                'warranty' => null,
                'featured' => false,
            ],
            // Kawat Las
            [
                'category_id' => $categories['Kawat Las'],
                'name' => 'Kawat Las MIG ER70S-6 0.8mm',
                'description' => 'Kawat las MIG ER70S-6 untuk pengelasan MIG',
                'specifications' => json_encode([
                    'diameter' => '0.8mm',
                    'type' => 'ER70S-6',
                    'material' => 'Besi Karbon',
                    'packaging' => '15kg/roll'
                ]),
                'brand' => 'Karya Jaya Las',
                'model' => 'MIG-08',
                'price' => 350000,
                'stock' => 50,
                'unit' => 'kg',
                'warranty' => null,
                'featured' => false,
            ],
            // Aksesoris
            [
                'category_id' => $categories['Aksesoris Las'],
                'name' => 'Helm Las Otomatis',
                'description' => 'Helm las otomatis dengan filter cahaya elektronik',
                'specifications' => json_encode([
                    'type' => 'Automatic Darkening',
                    'shade' => 'DIN 9-13',
                    'response_time' => '0.04ms',
                    'weight' => '0.5kg',
                    'material' => 'Plastic ABS'
                ]),
                'brand' => 'Karya Jaya Las',
                'model' => 'KJL-HELM',
                'price' => 450000,
                'stock' => 30,
                'unit' => 'unit',
                'warranty' => '6 bulan',
                'featured' => false,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}