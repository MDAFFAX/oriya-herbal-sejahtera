<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\COAController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\JurnalUmumController;
use App\Http\Controllers\TransaksiPenjualanController;
use App\Http\Controllers\BuktiNotaController;
use App\Http\Controllers\BukuBesarController;
use App\Http\Controllers\BebanOperasionalController;
use App\Http\Controllers\LaporanLabaRugiController;

// Login Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/kasir/dashboard', [KasirController::class, 'dashboard'])->name('kasir.dashboard');
    
    // COA Routes
    Route::resource('coa', COAController::class);
    
    // Produk Routes
    Route::resource('produk', ProdukController::class);
    
    // Pelanggan Routes
    Route::resource('pelanggan', PelangganController::class);
    
    // Beban Operasional Routes
    Route::resource('beban-operasional', BebanOperasionalController::class);
    
    // Laporan Routes
    Route::get('/jurnal-umum', [JurnalUmumController::class, 'index'])->name('jurnal-umum.index');
    Route::get('/buku-besar', [BukuBesarController::class, 'index'])->name('buku-besar.index');
    Route::get('/laporan-laba-rugi', [LaporanLabaRugiController::class, 'index'])->name('laporan-laba-rugi.index');
    Route::get('/laporan-laba-rugi/export-pdf', [LaporanLabaRugiController::class, 'exportPdf'])->name('laporan-laba-rugi.export-pdf');
    
    // Transaksi Penjualan Routes (Kasir)
    Route::get('/kasir/transaksi-penjualan/create', [TransaksiPenjualanController::class, 'create'])->name('kasir.transaksi-penjualan.create');
    Route::post('/kasir/transaksi-penjualan', [TransaksiPenjualanController::class, 'store'])->name('kasir.transaksi-penjualan.store');
    
    // Transaksi Penjualan Routes (Admin)
    Route::get('/admin/transaksi-penjualan', [TransaksiPenjualanController::class, 'index'])->name('admin.transaksi-penjualan.index');
    
    // Bukti Nota Routes (Kasir)
    Route::get('/kasir/bukti-nota', [BuktiNotaController::class, 'index'])->name('kasir.bukti-nota.index');
    Route::get('/bukti-nota/{id}', [BuktiNotaController::class, 'show'])->name('bukti-nota.show');
    Route::get('/bukti-nota/{id}/print', [BuktiNotaController::class, 'print'])->name('bukti-nota.print');
    
    // Bukti Nota Routes (Admin)
    Route::get('/admin/bukti-nota', [BuktiNotaController::class, 'adminIndex'])->name('admin.bukti-nota.index');
});

// Redirect root to login
Route::get('/', function () {
    return redirect()->route('login');
});
