<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\isAdmin;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('welcome');

});

Route::get('/dashboard', [DashboardController::class, 'indexPage']);
Route::get('/contact', [ContactController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('kategori', KategoriController::class);
Route::resource('produk', ProdukController::class);
