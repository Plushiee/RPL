<?php

use App\Http\Controllers\TransaksiController;
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

Route::post('/register/email', [RegisterController::class, 'email']);

// Login and Logout Controller
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login/loginCheck', [LoginController::class, 'loginCheck'])->name('loginCheck');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Pemilik Controller
Route::get('/pemilik/dashboard', [DashboardController::class, 'dashboard'])->middleware('auth'); //default pemilik
Route::get('/pemilik/dashboard/ambil', [DashboardController::class, 'ambil'])->middleware('auth'); //default pemilik
Route::get('/pemilik/akun', [DashboardController::class, 'akun'])->middleware('auth'); //default pemilik
Route::get('/pemilik/riwayat', [DashboardController::class, 'riwayat'])->middleware('auth'); //default pemilik
Route::post('/pemilik/simpanAkunAwal', [DashboardController::class, 'simpanAkunAwal'])->middleware('auth'); //default pemilik simpan data awal

// Simpan ambil dirumah
Route::post('/pemilik/dashboard/ambil/simpan/organik', [TransaksiController::class,'organik'])->middleware('auth'); // organik
Route::post('/pemilik/dashboard/ambil/simpan/kertas', [TransaksiController::class,'kertas'])->middleware('auth'); // kertas
Route::post('/pemilik/dashboard/ambil/simpan/plastik', [TransaksiController::class,'plastik'])->middleware('auth'); // kertas
Route::post('/pemilik/dashboard/ambil/simpan/kaca', [TransaksiController::class,'kaca'])->middleware('auth'); // kertas
Route::post('/pemilik/dashboard/ambil/simpan/logam', [TransaksiController::class,'logam'])->middleware('auth'); // kertas
Route::post('/pemilik/dashboard/ambil/simpan/lainnya', [TransaksiController::class,'lainnya'])->middleware('auth'); // kertas

// Pilih Akun Controller
Route::get('/pilih-akun', [PilihAkunController::class, 'pilihAkun']);
