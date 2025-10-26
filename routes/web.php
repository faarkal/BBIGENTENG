<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GoogleAuth;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\Admin\SejarahController as AdminSejarahController;
use App\Http\Controllers\Publik\SejarahController as PublikSejarahController;
use App\Http\Controllers\Admin\VisiMisiController;
use App\Http\Controllers\Publik\VisiMisiController as PublikVisiMisiController;
use App\Http\Controllers\Admin\ProfilBalaiController as AdminProfilBalaiController;
use App\Http\Controllers\Publik\ProfilBalaiController as PublikProfilBalaiController;
use App\Http\Controllers\Admin\BenihController;
use App\Http\Controllers\Admin\MasterBenihController;
use App\Http\Controllers\Admin\PemesananAdminController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Halaman Publik
Route::get('/sejarah', [PublikSejarahController::class, 'index'])->name('sejarah');
Route::get('/visi-misi', [PublikVisiMisiController::class, 'index'])->name('visi-misi');
Route::get('/pemesanan', [PemesananController::class, 'index'])->name('pemesanan.form');
Route::post('/pemesanan', [PemesananController::class, 'store'])->name('pemesanan');
Route::get('/profil-balai', [PublikProfilBalaiController::class, 'index'])->name('profil-balai');

// Google Auth
Route::get('/google', [GoogleAuth::class, 'redirectGoogle'])->name('google.auth');
Route::get('/google-callback', [GoogleAuth::class, 'handleGoogleCallback'])->name('google.login');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {

    // ------------------------------
    // Route tanpa login (guest)
    // ------------------------------
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminController::class, 'AdminLogin'])->name('login');
        Route::post('/login_submit', [AdminController::class, 'AdminLoginSubmit'])->name('login_submit');

        // Lupa Password
        Route::get('/forget_password', [AdminController::class, 'AdminForgetPassword'])->name('forget_password');
        Route::post('/password_submit', [AdminController::class, 'AdminPasswordSubmit'])->name('password_submit');
        Route::get('/reset-password/{token}/{email}', [AdminController::class, 'AdminResetPassword'])->name('reset_password');
        Route::post('/reset-password-submit', [AdminController::class, 'AdminResetPasswordSubmit'])->name('reset_password_submit');
    });

    // ------------------------------
    // Route untuk admin yang sudah login
    // ------------------------------
    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'AdminDashboard'])->name('dashboard');
        Route::match(['get', 'post'], '/logout', [AdminController::class, 'AdminLogout'])->name('logout');

        // Konten Admin
        Route::get('/sejarah', [AdminSejarahController::class, 'index'])->name('sejarah');
        Route::post('/sejarah/update', [AdminSejarahController::class, 'update'])->name('sejarah.update');

        Route::get('/visi-misi', [VisiMisiController::class, 'index'])->name('visi-misi.index');
        Route::post('/visi-misi/update', [VisiMisiController::class, 'update'])->name('visi-misi.update');

        Route::get('/profil-balai', [AdminProfilBalaiController::class, 'index'])->name('profil-balai.index');
        Route::post('/profil-balai/update', [AdminProfilBalaiController::class, 'update'])->name('profil-balai.update');

        // Pengelolaan Benih Ikan
        Route::resource('benih', BenihController::class);

        // Data Master Benih Ikan
        Route::resource('master-benih', MasterBenihController::class);

        // Pengelolaan Pemesanan
        Route::get('/pemesanan', [PemesananAdminController::class, 'index'])->name('pemesanan.index');
        Route::post('/pemesanan/{id}/konfirmasi', [PemesananAdminController::class, 'konfirmasi'])->name('pemesanan.konfirmasi');
        Route::post('/pemesanan/{id}/tolak', [PemesananAdminController::class, 'tolak'])->name('pemesanan.tolak');
    });
});


/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
