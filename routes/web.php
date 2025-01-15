<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MinusController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

Route::get('/', function () {
    return view('login.login'); 
});

Route::get('/register', function () {
    return view('register.register'); 
});

Route::get('/home', function () {
    return view('home.home'); 
});

Route::get('/login-admin', function () {
    return view('admin.login.login'); 
});

Route::get('/dashboard-admin', function () {
    return view('admin.dashboard.dashboard'); 
});

Route::get('/artikel-admin', function () {
    return view('admin.artikel.artikel'); 
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);


Route::prefix('admin')->group(function () {
    Route::view('/dashboard-admin', 'admin.dashboard.dashboard')->name('admin.dashboard.dashboard');
    Route::view('/dealer-admin', 'admin.dealer.dealer')->name('admin.dealer.dealer');
    Route::view('/artikel-admin', 'admin.artikel.artikel')->name('admin.artikel.artikel');
});

Route::get('/images-product/{filename}', function ($filename) {
    $path = public_path('images-product/'.$filename);

    if (! File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header('Content-Type', $type);

    return $response;
});

