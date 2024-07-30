<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware(['auth:santus', 'delivery.time'])->group(function () {
    Route::get('profile', [AuthController::class, 'profile']);

    Route::middleware(['role:staff'])->group(function () {
        Route::apiResource('menus', MenuController::class)->except(['index', 'show']);
        Route::get('users', [UserController::class, 'index']);
        Route::get('users/{id}', [UserController::class, 'show']);
    });

    Route::middleware(['role:customer,staff'])->group(function () {
        Route::get('menus', [MenuController::class, 'index']);
        Route::get('menus/{id}', [MenuController::class, 'show']);
        Route::get('menus/discounted', [MenuController::class, 'discounted']);
        Route::get('menus/drinks', [MenuController::class, 'drinks']);

        Route::post('orders', [OrderController::class, 'store']);
        Route::get('orders', [OrderController::class, 'index']);
    });
});
