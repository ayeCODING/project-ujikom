<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ContactController;
use App\Http\Middleware\IsAdmin;

Route::get('/contact', [ContactController::class, 'index']);

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Halaman Home (Hanya Bisa diakses jika login)
Route::get('/home', function () {
    return view('home');
})->middleware('auth')->name('home');

// Route untuk login & register
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// ✅ Gunakan `Route::group()` untuk admin
Route::group(['prefix' => 'admin', 'middleware' => ['auth', IsAdmin::class]], function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    // untuk Route Backend Lainnya
    Route::resource('kategori', KategoriController::class);
    Route::resource('produk', ProdukController::class);
});
// ✅ Proteksi untuk user yang login
Route::middleware(['auth'])->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
});

Auth::routes();
