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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/contact', [ContactController::class, 'index']);
Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => ['auth', isAdmin::class]], function () {
    Route::get('/', function () {
        return view('include.backend.dashboard');
    });
    // untuk Route Backend Lainnya
    Route::resource('kategori', KategoriController::class);
    Route::resource('produk', ProdukController::class);

});
