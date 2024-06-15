<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;

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


// Authentication
Route::prefix('produk')->group(function(){
    Route::post('/produk', [ProdukController::class, 'login']);
});