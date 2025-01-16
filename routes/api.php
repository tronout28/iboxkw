<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MinusController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ArtikelController;

Route::group(['prefix' => '/auth'], function () {
    Route::post('/register-user', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/register-as', [AuthController::class, 'registeras']);
});

Route::group(['prefix' => '/product'], function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/get-product/{id}', [ProductController::class, 'show']);

    Route::group(['middleware' => ['auth:sanctum', 'role:admin']], function () {
        Route::post('/store', [ProductController::class, 'store']);
        Route::post('/store-image', [ProductController::class, 'insertimage']);
        Route::put('/update/{id}', [ProductController::class, 'update']);
        Route::delete('/delete/{id}', [ProductController::class, 'destroy']);
    });
});

    Route::group(['prefix' => '/minus'], function () {
        Route::get('/', [MinusController::class, 'index']);
        Route::get('/get-minus/{id}', [MinusController::class, 'show']);
        Route::get('/get-product/{id}', [MinusController::class, 'showProducts']);
        Route::get('/get-category/{id}', [MinusController::class, 'showMinusByCategory']);
        
        Route::group(['middleware' => ['auth:sanctum', 'role:admin']], function () {
            Route::post('/store', [MinusController::class, 'store']);
            Route::put('/update/{id}', [MinusController::class, 'update']);
            Route::delete('/delete/{id}', [MinusController::class, 'destroy']);
        });
    });

Route::group(['prefix' => '/artikel'], function () {
    Route::get('/', [ArtikelController::class, 'index']);
    Route::get('/get-artikel/{id}', [ArtikelController::class, 'show']);

    Route::group(['middleware' => ['auth:sanctum', 'role:admin']], function () {
        Route::post('/store', [ArtikelController::class, 'store']);
        Route::put('/update/{id}', [ArtikelController::class, 'update']);
        Route::delete('/delete/{id}', [ArtikelController::class, 'destroy']);
    });
});
