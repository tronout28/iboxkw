<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name_iphone' => 'Iphone X','created_at' => now(), 'updated_at' => now()],
            ['name_iphone' => 'Iphone XR','created_at' => now(), 'updated_at' => now()],
            ['name_iphone' => 'Iphone XS','created_at' => now(), 'updated_at' => now()],
            ['name_iphone' => 'Iphone XS Max','created_at' => now(), 'updated_at' => now()],
            ['name_iphone' => 'Iphone 11','created_at' => now(), 'updated_at' => now()],
            ['name_iphone' => 'Iphone 11 Pro','created_at' => now(), 'updated_at' => now()],
            ['name_iphone' => 'Iphone 11 Pro Max','created_at' => now(), 'updated_at' => now()],
            ['name_iphone' => 'Iphone 12','created_at' => now(), 'updated_at' => now()],
            ['name_iphone' => 'Iphone 12 Pro','created_at' => now(), 'updated_at' => now()],
            ['name_iphone' => 'Iphone 12 Pro Max','created_at' => now(), 'updated_at' => now()],
            ['name_iphone' => 'Iphone 13','created_at' => now(), 'updated_at' => now()],
            ['name_iphone' => 'Iphone 13 Pro','created_at' => now(), 'updated_at' => now()],
            ['name_iphone' => 'Iphone 13 Pro Max','created_at' => now(), 'updated_at' => now()],
            ['name_iphone' => 'Iphone 14','created_at' => now(), 'updated_at' => now()],
            ['name_iphone' => 'Iphone 14 Pro','created_at' => now(), 'updated_at' => now()],
            ['name_iphone' => 'Iphone 14 Pro Max','created_at' => now(), 'updated_at' => now()],
            ['name_iphone' => 'Iphone 15','created_at' => now(), 'updated_at' => now()],
            ['name_iphone' => 'Iphone 15 Pro','created_at' => now(), 'updated_at' => now()],
            ['name_iphone' => 'Iphone 15 Pro Max','created_at' => now(), 'updated_at' => now()]
        ]);
    }
}
