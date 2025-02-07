<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Support\Facades\Route;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        
    Route::bind('kategori', function ($value) {
        return Kategori::where('slug', $value)->firstOrFail();
    });

    Route::bind('produk', function ($value) {
        return Produk::where('slug', $value)->firstOrFail();
    });
    }
}
