<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


class MinusSeeder extends Seeder
{
 /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Temporarily disable foreign key checks
        Schema::disableForeignKeyConstraints();

        // Clear existing data in correct order
        DB::table('category_minuses')->truncate();
        DB::table('minuses')->truncate();

        // Re-enable foreign key checks
        Schema::enableForeignKeyConstraints();

        // Base minus products (will be used as reference)
        $minusProducts = [
            'Face ID', 'layar', 'spiker', 'tombol power', 
            'tombol volume up', 'tombol volume down', 
            'kamera depan', 'kamera belakang', 'lampu flash', 'microphone'
        ];

        // Category groupings with their specific prices
        $categoryPrices = [
            [
                'categories' => ['Iphone X', 'Iphone 11', 'Iphone 12','Iphone XR'],
                'prices' => [
                    'Face ID' => 500000,
                    'layar' => 450000,
                    'spiker' => 200000,
                    'tombol power' => 150000,
                    'tombol volume up' => 100000,
                    'tombol volume down' => 100000,
                    'kamera depan' => 350000,
                    'kamera belakang' => 400000,
                    'lampu flash' => 100000,
                    'microphone' => 100000,
                ]
            ],
            [
                'categories' => ['Iphone XS', 'Iphone XS Max'],
                'prices' => [
                    'Face ID' => 500000,
                    'layar' => 550000,
                    'spiker' => 200000,
                    'tombol power' => 150000,
                    'tombol volume up' => 100000,
                    'tombol volume down' => 100000,
                    'kamera depan' => 350000,
                    'kamera belakang' => 400000,
                    'lampu flash' => 100000,
                    'microphone' => 100000,
                ]
            ],
            [
                'categories' => ['Iphone 11 Pro', 'Iphone 11 Pro Max'],
                'prices' => [
                    'Face ID' => 500000,
                    'layar' => 650000,
                    'spiker' => 200000,
                    'tombol power' => 150000,
                    'tombol volume up' => 100000,
                    'tombol volume down' => 100000,
                    'kamera depan' => 350000,
                    'kamera belakang' => 400000,
                    'lampu flash' => 100000,
                    'microphone' => 100000,
                ]
            ],
            [
                'categories' => ['Iphone 12 Pro', 'Iphone 12 Pro Max'],
                'prices' => [
                    'Face ID' => 500000,
                    'layar' => 1650000,
                    'spiker' => 200000,
                    'tombol power' => 150000,
                    'tombol volume up' => 100000,
                    'tombol volume down' => 100000,
                    'kamera depan' => 350000,
                    'kamera belakang' => 400000,
                    'lampu flash' => 100000,
                    'microphone' => 100000,
                ]
            ],
            [
                'categories' => ['Iphone 13', 'Iphone 14'],
                'prices' => [
                    'Face ID' => 500000,
                    'layar' => 750000,
                    'spiker' => 200000,
                    'tombol power' => 150000,
                    'tombol volume up' => 100000,
                    'tombol volume down' => 100000,
                    'kamera depan' => 350000,
                    'kamera belakang' => 400000,
                    'lampu flash' => 100000,
                    'microphone' => 100000,
                ]
            ],
            [
                'categories' => ['Iphone 13 Pro', 'Iphone 13 Pro Max'],
                'prices' => [
                    'Face ID' => 500000,
                    'layar' => 3500000,
                    'spiker' => 200000,
                    'tombol power' => 150000,
                    'tombol volume up' => 100000,
                    'tombol volume down' => 100000,
                    'kamera depan' => 350000,
                    'kamera belakang' => 400000,
                    'lampu flash' => 100000,
                    'microphone' => 100000,
                ]
            ],
            [
                'categories' => ['Iphone 14 Pro', 'Iphone 14 Pro Max'],
                'prices' => [
                    'Face ID' => 500000,
                    'layar' => 4500000,
                    'spiker' => 200000,
                    'tombol power' => 150000,
                    'tombol volume up' => 100000,
                    'tombol volume down' => 100000,
                    'kamera depan' => 350000,
                    'kamera belakang' => 400000,
                    'lampu flash' => 100000,
                    'microphone' => 100000,
                ]
            ],
            [
                'categories' => ['Iphone 15'],
                'prices' => [
                    'Face ID' => 500000,
                    'layar' => 3500000,
                    'spiker' => 200000,
                    'tombol power' => 150000,
                    'tombol volume up' => 100000,
                    'tombol volume down' => 100000,
                    'kamera depan' => 350000,
                    'kamera belakang' => 400000,
                    'lampu flash' => 100000,
                    'microphone' => 100000,
                ]
            ],
            [
                'categories' => ['Iphone 15 Pro', 'Iphone 15 Pro Max'],
                'prices' => [
                    'Face ID' => 500000,
                    'layar' => 6500000,
                    'spiker' => 200000,
                    'tombol power' => 150000,
                    'tombol volume up' => 100000,
                    'tombol volume down' => 100000,
                    'kamera depan' => 350000,
                    'kamera belakang' => 400000,
                    'lampu flash' => 100000,
                    'microphone' => 100000,
                ]
            ],
        ];

        // Insert all unique minus combinations
        $minusIds = [];
        foreach ($categoryPrices as $categoryGroup) {
            foreach ($minusProducts as $product) {
                $price = $categoryGroup['prices'][$product];
                $minusId = DB::table('minuses')->insertGetId([
                    'minus_product' => $product,
                    'minus_price' => $price,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Store the minus ID for each product and price combination
                $key = $product . '_' . $price;
                $minusIds[$key] = $minusId;
            }
        }

        // Create category-minus relationships
        foreach ($categoryPrices as $categoryGroup) {
            foreach ($categoryGroup['categories'] as $categoryName) {
                $categoryId = DB::table('categories')
                    ->where('name_iphone', $categoryName)
                    ->value('id');

                if ($categoryId) {
                    foreach ($minusProducts as $product) {
                        $price = $categoryGroup['prices'][$product];
                        $key = $product . '_' . $price;
                        
                        DB::table('category_minuses')->insert([
                            'category_id' => $categoryId,
                            'minus_id' => $minusIds[$key],
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }
        }
    }
}
