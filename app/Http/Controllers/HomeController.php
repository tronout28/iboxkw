<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $slides = [
            ['image' => 'path/to/image1.jpg', 'title' => 'iPhone 16 Pro', 'description' => 'Cek kembali untuk informasi ketersediaan.'],
            ['image' => 'path/to/image2.jpg', 'title' => 'MacBook Pro', 'description' => 'Desain baru yang revolusioner.'],
        ];

        $products = [
            ['image' => 'path/to/mac.jpg', 'name' => 'Mac', 'price' => 'Rp12 juta'],
            ['image' => 'path/to/iphone.jpg', 'name' => 'iPhone', 'price' => 'Rp7 juta'],
            ['image' => 'path/to/ipad.jpg', 'name' => 'iPad', 'price' => 'Rp5 juta'],
            ['image' => 'path/to/watch.jpg', 'name' => 'Apple Watch', 'price' => 'Rp4 juta'],
            ['image' => 'path/to/airtag.jpg', 'name' => 'AirTag', 'price' => 'Rp400 ribu'],
        ];

        return view('home', compact('slides', 'products'));
    }
}
