<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProductSeeder extends Seeder
{
   
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tambahkan produk ke tabel `products`
        $products = [
            [
                'name' => 'Iphone 11',
                'price' => 6000000,
                'description' => 'Iphone 11 64GB',
                'category' => 'Iphone',
                'requested' => 'accepted',
                'status' => 'active',
                'user_id' => 3,
                'minuses' => [1, 2], // ID minus terkait
            ],
            [
                'name' => 'Iphone 12',
                'price' => 8000000,
                'description' => 'Iphone 12 64GB',
                'category' => 'Iphone',
                'requested' => 'accepted',
                'status' => 'active',
                'user_id' => 3,
                'minuses' => [2], // ID minus terkait
            ],
        ];

        foreach ($products as $product) {
            // Masukkan data produk ke tabel `products`
            $productId = DB::table('products')->insertGetId([
                'name' => $product['name'],
                'price' => $product['price'],
                'description' => $product['description'],
                'category' => $product['category'],
                'requested' => $product['requested'],
                'status' => $product['status'],
                'user_id' => $product['user_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Masukkan relasi ke tabel `minus_products`
            foreach ($product['minuses'] as $minusId) {
                DB::table('minus_products')->insert([
                    'product_id' => $productId,
                    'minus_id' => $minusId,
                    'total_price' => $product['price'] - DB::table('minuses')->where('id', $minusId)->value('minus_price'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
