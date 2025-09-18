<?php

use App\Http\Controllers\SerpController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SerpController::class, 'index'])->name('home');
Route::post('/search', [SerpController::class, 'search'])->name('search');
