<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PilihAkunController;
use App\Http\Controllers\DefaultController;

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
Route::get('/', [DefaultController::class, 'index']);

// Register Controller
Route::get('/register', [RegisterController::class, 'register']);
Route::get('/register/auth', [RegisterController::class, 'auth']);

// Login Controller
Route::get('/login', [LoginController::class, 'login']);

// Pemilik Controller
Route::get('/pemilik/dashboard', [DashboardController::class, 'dashboard']); //default pemilik
Route::get('/pemilik/dashboard/ambil', [DashboardController::class, 'ambil']); //default pemilik

Route::get('/pemilik/akun', [DashboardController::class, 'akun']); //default pemilik

// Pilih Akun Controller
Route::get('/pilih-akun', [PilihAkunController::class, 'pilihAkun']);
