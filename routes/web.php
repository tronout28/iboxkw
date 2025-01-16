<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MinusController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

Route::get('/', function () {
    return view('login.login'); 
});

Route::get('/checkout/{id}', [ProductController::class, 'show']);

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

Route::get('/api/categories', [CategoryController::class, 'index']);
Route::get('/api/minuses', [MinusController::class, 'index']);

Route::get('/sell', function () {
    return view('sell.sell');
})->name('sell');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/api/products', [ProductController::class, 'index']);
Route::get('/get-artikel', [ArtikelController::class, 'index']);
Route::post('/artikel', [ArtikelController::class, 'store']);

Route::get('/products', [ProductController::class, 'getProducts'])->name('products.data');
Route::delete('/products/{id}', [ProductController::class, 'destroy']);
Route::get('/admin/dealer/{id}/detail', [ProductController::class, 'showAdmin'])->name('admin.dealer.detail');
Route::get('/admin/dealer/{id}/edit', [ProductController::class, 'edit'])->name('admin.dealer.edit');
Route::put('/admin/dealer/{id}/update', [ProductController::class, 'update'])->name('admin.dealer.update');
Route::get('/admin/dealer', [ProductController::class, 'index'])->name('admin.dealer.index');

Route::get('/artikel/{id}', [ArtikelController::class, 'show']);
Route::post('/api/products', [ProductController::class, 'store']);

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
