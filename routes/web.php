<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PilihAkunController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Login Controller
Route::get('/', [LoginController::class, 'login']);

// Register Controller
Route::get('/register', [RegisterController::class, 'register']);

// Dashboard Controller
Route::get('/pemilik/dashboard', [DashboardController::class, 'dashboard']); //default pemilik
Route::get('/pemilik/dashboard/ambil', [DashboardController::class, 'ambil']); //default pemilik



// Pilih Akun Controller
Route::get('/pilih-akun', [PilihAkunController::class, 'pilihAkun']);
