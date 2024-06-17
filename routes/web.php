<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Authentication
Route::prefix('auth')->group(function(){
    Route::post('/login', [LoginController::class, 'login']);
});

Route::get('/dashboard', [DashboardController::class, 'dashboard']);
Route::get('/', [LoginController::class, 'isLoggedIn']);
Route::get('logout', [LoginController::class, 'logout']);

// Authentication
Route::prefix('produk')->group(function(){
    Route::get('/', [ProdukController::class, 'index']);
    Route::get('/tambah', [ProdukController::class, 'tambah']);
    Route::post('/store', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/ubah/{id}', [ProdukController::class, 'ubah']);
    Route::post('/update', [ProdukController::class, 'update'])->name('produk.update');
    Route::post('/data', [ProdukController::class, 'data']);
    Route::get('/delete/{id}', [ProdukController::class, 'delete']);
});


// Authentication
Route::prefix('transaksi')->group(function(){
    Route::get('/', [TransaksiController::class, 'index']);
    Route::get('/tambah', [TransaksiController::class, 'tambah']);
    Route::post('/store', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::get('/formatSuplier', [TransaksiController::class, 'formatSuplier']);
    Route::post('/formatProduk', [TransaksiController::class, 'formatProduk']);
    Route::post('/data', [TransaksiController::class, 'data']);
    Route::get('/data', [TransaksiController::class, 'data']);
});