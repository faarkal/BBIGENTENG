<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProfileController,
    AdminController,
    GoogleAuth,
    PemesananController,
    Admin\SejarahController as AdminSejarahController,
    Publik\SejarahController as PublikSejarahController,
    Admin\VisiMisiController,
    Admin\VideoController,
    Publik\VisiMisiController as PublikVisiMisiController,
    Admin\ProfilBalaiController as AdminProfilBalaiController,
    Publik\ProfilBalaiController as PublikProfilBalaiController,
    Admin\BenihController,
    Admin\MasterBenihController,
    Admin\PemesananAdminController,
    Publik\LaporanBenihController as PublikLaporanBenihController,
    Admin\LaporanBenihController as AdminLaporanBenihController,
    Publik\LaporanIndukController as PublikLaporanIndukController,
    Admin\LaporanIndukController as AdminLaporanIndukController,
    Admin\MonitoringController
};

// ============================
// Public Routes
// ============================
Route::get('/', fn() => view('welcome'));

Route::get('/sejarah', [PublikSejarahController::class, 'index'])->name('sejarah');
Route::get('/visi-misi', [PublikVisiMisiController::class, 'index'])->name('visi-misi');
Route::get('/profil-balai', [PublikProfilBalaiController::class, 'index'])->name('profil-balai');
Route::get('/laporan-benih', [PublikLaporanBenihController::class, 'index'])->name('laporan-benih');
Route::get('/laporan-induk', [PublikLaporanIndukController::class, 'index'])->name('laporan-induk');

Route::get('/pemesanan', [PemesananController::class, 'index'])->name('pemesanan.form');
Route::post('/pemesanan', [PemesananController::class, 'store'])->name('pemesanan');

// Google Auth
Route::get('/google', [GoogleAuth::class, 'redirectGoogle'])->name('google.auth');
Route::get('/google-callback', [GoogleAuth::class, 'handleGoogleCallback'])->name('google.login');

// ============================
// Admin Routes
// ============================
Route::prefix('admin')->name('admin.')->group(function () {

    // Guest (belum login)
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminController::class, 'AdminLogin'])->name('login');
        Route::post('/login_submit', [AdminController::class, 'AdminLoginSubmit'])->name('login_submit');

        Route::get('/forget_password', [AdminController::class, 'AdminForgetPassword'])->name('forget_password');
        Route::post('/password_submit', [AdminController::class, 'AdminPasswordSubmit'])->name('password_submit');
        Route::get('/reset-password/{token}/{email}', [AdminController::class, 'AdminResetPassword'])->name('reset_password');
        Route::post('/reset-password-submit', [AdminController::class, 'AdminResetPasswordSubmit'])->name('reset_password_submit');
    });

    // Admin (sudah login)
    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'AdminDashboard'])->name('dashboard');
        Route::match(['get', 'post'], '/logout', [AdminController::class, 'AdminLogout'])->name('logout');

        Route::get('/sejarah', [AdminSejarahController::class, 'index'])->name('sejarah');
        Route::post('/sejarah/update', [AdminSejarahController::class, 'update'])->name('sejarah.update');

        Route::get('/visi-misi', [VisiMisiController::class, 'index'])->name('visi-misi.index');
        Route::post('/visi-misi/update', [VisiMisiController::class, 'update'])->name('visi-misi.update');

        Route::get('/profil-balai', [AdminProfilBalaiController::class, 'index'])->name('profil-balai.index');
        Route::post('/profil-balai/update', [AdminProfilBalaiController::class, 'update'])->name('profil-balai.update');

        Route::resource('benih', BenihController::class);
        Route::resource('master-benih', MasterBenihController::class);

        // Monitoring
        Route::get('/monitoring', [MonitoringController::class, 'index'])->name('monitoring.index');
        Route::get('/monitoring/create', [MonitoringController::class, 'create'])->name('monitoring.create');
        Route::post('/monitoring', [MonitoringController::class, 'store'])->name('monitoring.store');
        Route::get('/monitoring/{id}/monitoring', [MonitoringController::class, 'monitoring'])->name('monitoring.monitoring');
        Route::put('/monitoring/{id}', [MonitoringController::class, 'update'])->name('monitoring.update');
        Route::delete('/monitoring/{id}', [MonitoringController::class, 'destroy'])->name('monitoring.destroy');


        // Pemesanan
        Route::get('/pemesanan', [PemesananAdminController::class, 'index'])->name('pemesanan.index');
        Route::post('/pemesanan/{id}/konfirmasi', [PemesananAdminController::class, 'konfirmasi'])->name('pemesanan.konfirmasi');
        Route::post('/pemesanan/{id}/tolak', [PemesananAdminController::class, 'tolak'])->name('pemesanan.tolak');

        // Laporan Benih
        Route::get('/laporan-benih', [AdminLaporanBenihController::class, 'index'])->name('laporan-benih.index');
        Route::post('/laporan-benih/store', [AdminLaporanBenihController::class, 'store'])->name('laporan-benih.store');
        Route::delete('/laporan-benih/{id}', [AdminLaporanBenihController::class, 'destroy'])->name('laporan-benih.destroy');

        // Laporan Akhir (Bulanan)
        Route::get('/laporan-akhir', [\App\Http\Controllers\Admin\LaporanAkhirController::class, 'index'])->name('laporan-akhir.index');

        // Laporan Induk
        Route::get('/laporan-induk', [AdminLaporanIndukController::class, 'index'])->name('laporan-induk.index');
        Route::post('/laporan-induk/store', [AdminLaporanIndukController::class, 'store'])->name('laporan-induk.store');
        Route::delete('/laporan-induk/{id}', [AdminLaporanIndukController::class, 'destroy'])->name('laporan-induk.destroy');

        // Video
        Route::get('videos', [VideoController::class, 'index'])->name('videos.index');
        Route::get('videos/create', [VideoController::class, 'create'])->name('videos.create');
        Route::post('videos', [VideoController::class, 'store'])->name('videos.store');
    });
});

// ============================
// Authenticated User Routes
// ============================
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'))->middleware(['verified'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
