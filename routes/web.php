<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Master\BarangController;
use App\Http\Controllers\Master\SupplierController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Transaksi\PembelianController;
use App\Http\Controllers\Transaksi\PenjualanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/',[DashboardController::class,'index'])->name('dashboard');
    
    // Menu Master
    Route::resource('suppliers', SupplierController::class);
    Route::resource('barangs', BarangController::class);

    // Menu Transaksi
    Route::resource('penjualans',PenjualanController::class);
    Route::resource('pembelians', PembelianController::class);

    // Menu Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
