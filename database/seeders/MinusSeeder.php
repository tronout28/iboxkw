<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class MinusSeeder extends Seeder
{
 /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('minuses')->insert([
            ['minus_product' => 'Layar pecah', 'minus_price' => 1000000],
            ['minus_product' => 'Baterai kembung', 'minus_price' => 500000],
        ]);
    }
}
