<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MinusController;
use App\Http\Controllers\ProductController;

Route::group(['prefix' => '/auth'], function () {
    Route::post('/register-user', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/register-as', [AuthController::class, 'registeras']);
});

Route::group(['prefix' => '/product'], function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/get-product/{id}', [ProductController::class, 'show']);

    Route::group(['middleware' => ['auth:sanctum', 'role:admin|dealer']], function () {
        Route::post('/store', [ProductController::class, 'store']);
        Route::post('/store-image', [ProductController::class, 'insertimage']);
    });

    Route::group(['middleware' => ['auth:sanctum', 'role:admin']], function () {
        Route::put('/update/{id}', [ProductController::class, 'update']);
        Route::delete('/delete/{id}', [ProductController::class, 'destroy']);
    });
});

Route::group(['prefix' => '/minus'], function () {
    Route::get('/', [MinusController::class, 'index']);
    Route::get('/get-minus/{id}', [MinusController::class, 'show']);
    Route::get('/get-product/{id}', [MinusController::class, 'showProducts']);

    Route::group(['middleware' => ['auth:sanctum', 'role:admin']], function () {
        Route::post('/store', [MinusController::class, 'store']);
        Route::put('/update/{id}', [MinusController::class, 'update']);
        Route::delete('/delete/{id}', [MinusController::class, 'destroy']);
    });
});
