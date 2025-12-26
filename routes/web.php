<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/berita', [ArticleController::class, 'index'])
    ->name('articles.index');

Route::get('/berita/{slug}', [ArticleController::class, 'show'])
    ->name('articles.show');

Route::get('/kategori/{slug}', [ArticleController::class, 'category'])
    ->name('articles.category');

Route::get('/profil', [ProfileController::class, 'index'])
    ->name('profile');

