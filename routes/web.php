<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'dashboard'])->name('dashboard');

Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::get('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'authenticate']);

Route::post('/register', [AuthController::class, 'create']);

Route::get('/logout', [AuthController::class, 'logout']);