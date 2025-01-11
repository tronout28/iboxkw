<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.home'); // Arahkan ke file resources/views/home/home.blade.php
});
