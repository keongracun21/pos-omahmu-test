<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    AuthController,
    ProfileController,
    DashboardController,
    UserController,
    StokMenuController,
    OrderController,
    LaporanController,
    BarangController
};

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication Routes
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login')->name('login.submit');
    Route::post('/logout', 'logout')->name('logout');
});

// Authenticated Routes
Route::middleware(['auth', 'prevent-back-history'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // StokMenu Routes (menggunakan resource untuk route CRUD otomatis)
    Route::resource('stok_menu', StokMenuController::class)->except(['create', 'edit']); // Menyembunyikan create/edit jika menggunakan modal
    Route::put('/stok_menu/{id}/update-stok', [StokMenuController::class, 'updateStok'])->name('stok_menu.update-stok');
    Route::get('/stok_menu/low-stock', [StokMenuController::class, 'getLowStock'])->name('stok_menu.low-stock');
    Route::delete('/stok_menu/{id}', [StokMenuController::class, 'destroy'])->name('stok_menu.destroy');

    // Profile Settings
    Route::prefix('pengaturan')->controller(ProfileController::class)->group(function () {
        Route::get('/', 'index')->name('pengaturan');
        Route::put('/update', 'update')->name('pengaturan.update');
    });

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');

    // Barang Routes
    Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
    Route::post('/bahan/store', [BarangController::class, 'store'])->name('bahan.store');
    Route::post('/barang/restok-batch', [BarangController::class, 'restokBatch'])->name('barang.restok-batch');

    // Order Routes
    Route::post('/submit-order', [OrderController::class, 'submit'])->name('order.submit');

    // User Management
    Route::prefix('users')->name('users.')->group(function () {
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/create', [UserController::class, 'create'])->name('create'); // Jika ingin form terpisah
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{id}', [UserController::class, 'update'])->name('update');
    });

    // Tambahkan route authenticated lainnya di sini
});

Route::post('/subscribe', [App\Http\Controllers\SubscribeController::class, 'store']);
