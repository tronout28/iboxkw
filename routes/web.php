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
    return view('home.home'); 
});

Route::get('/checkout/{id}', [ProductController::class, 'show']);

Route::get('/profile', function () {
    return view('profile.profile'); 
})->middleware('auth')->name('profile');


Route::get('/register', function () {
    return view('register.register'); 
})->name('register');

Route::get('/login', function () {
    return view('login.login'); 
})->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/home', function () {
    return view('home.home'); 
});

route::get('/catalogue', function () {
    return view('filtered.filtered');
});

Route::get('/products-by-category', [ProductController::class, 'showProductsByCategory']);


Route::post('/loginAdmin', [AuthController::class, 'loginAdmin']);


Route::get('/login-admin', function () {
    return view('admin.login.login'); 
});

Route::get('/artikel-admin', function () {
    return view('admin.artikel.artikel'); 
});

Route::get('/api/categories', [CategoryController::class, 'index']);
Route::get('/api/minuses/category/{category_id}', [MinusController::class, 'showMinusByCategory']);

Route::get('/sell', function () {
    return view('sell.sell');
})->middleware('auth')->name('sell');


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/api/products', [ProductController::class, 'index']);
Route::get('/get-artikel', [ArtikelController::class, 'index']);
Route::post('/artikel', [ArtikelController::class, 'store']);
Route::get('/filtered-products', [ProductController::class, 'getFilteredProducts']);


Route::get('/products', [ProductController::class, 'getProducts']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);
Route::get('/admin/dealer/{id}/detail', [ProductController::class, 'showAdmin'])->name('admin.dealer.detail');
Route::get('/admin/dealer/{id}/edit', [ProductController::class, 'edit'])->name('admin.dealer.edit');
Route::put('/admin/dealer/{id}/update', [ProductController::class, 'update'])->name('admin.dealer.update');
Route::get('/admin/dealer', [ProductController::class, 'index'])->name('admin.dealer.index');
Route::delete('/artikels/{id}', [ArtikelController::class, 'destroy'])->name('artikels.destroy');

Route::get('/artikel/{id}', [ArtikelController::class, 'show']);
Route::post('/api/products', [ProductController::class, 'store']);

Route::prefix('admin')->group(function () {
    Route::view('/dashboard-admin', 'admin.dashboard.dashboard')->name('admin.dashboard.dashboard');
    Route::view('/dealer-admin', 'admin.dealer.dealer')->name('admin.dealer.dealer');
    Route::view('/artikel-admin', 'admin.artikel.artikel')->name('admin.artikel.artikel');
})->middleware('role:admin');

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

Route::get('/images-artikel/{filename}', function ($filename) {
    $path = public_path('images-artikel/'.$filename);

    if (! File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header('Content-Type', $type);

    return $response;
});