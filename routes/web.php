<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/register', [App\Http\Controllers\HomeController::class, 'register']);
Route::get('/login', [App\Http\Controllers\HomeController::class, 'login']);
