<?php

use App\Http\Controllers\AmbilGambarController;
use App\Http\Controllers\GantiInformasiAkunController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PilihAkunController;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\AmbilPengambilController;

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

// Redirect
Route::redirect('/pemilik', '/pemilik/dashboard');
Route::redirect('/pengambil', '/pengambil/dashboard');

// Register Controller
Route::get('/register', [RegisterController::class, 'register']);
Route::get('/register/auth', [RegisterController::class, 'auth']);

Route::post('/register/email', [RegisterController::class, 'email']);

// Login and Logout Controller
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login/loginCheck', [LoginController::class, 'loginCheck'])->name('loginCheck');

Route::middleware(['auth:pemilik'])->group(function () {
    // Pemilik Controller
    Route::get('/pemilik/dashboard', [DashboardController::class, 'dashboard']); //default pemilik
    Route::get('/pemilik/dashboard/ambil', [DashboardController::class, 'ambil']); //antar pemilik
    Route::get('/pemilik/dashboard/antar', [DashboardController::class, 'antar']); //ambil pemilik
    Route::get('/pemilik/akun', [DashboardController::class, 'akun']); //akun pemilik
    Route::get('/pemilik/riwayat', [DashboardController::class, 'riwayat']); //riwayat pemilik
    Route::get('/pemilik/pembayaran', [DashboardController::class, 'pembayaran'])->name('pembayaran'); //riwayat pemilik
    Route::post('/pemilik/simpanAkunAwal', [DashboardController::class, 'simpanAkunAwal']); //simpan data awal pemilik

    // Ganti Data Akun
    Route::post('/pemilik/akun/passwordCheck', [GantiInformasiAkunController::class, 'passwordCheck']); //cek password
    Route::post('/pemilik/akun/gantiDataAkun', [GantiInformasiAkunController::class, 'gantiDataAkunPemilik']); //Ganti data akun pemilik
    Route::post('/pemilik/akun/gantiDataPemilik', [GantiInformasiAkunController::class, 'gantiDataPemilik']); //Ganti data akun pemilik

    // Daftar
    Route::post('/pemilik/akun/daftarPengambil', [GantiInformasiAkunController::class, 'daftarPengambil']); // Daftar Pengambil

    // Pembayaran
    Route::post('/pemilik/pembaran/simpanbukti', [TransaksiController::class, 'simpanbukti'])->name('uploadBukti'); //Lihat bukti

    // Simpan ambil dirumah
    Route::post('/pemilik/dashboard/ambil/simpan/organik', [TransaksiController::class, 'organik']); // organik
    Route::post('/pemilik/dashboard/ambil/simpan/kertas', [TransaksiController::class, 'kertas']); // kertas
    Route::post('/pemilik/dashboard/ambil/simpan/plastik', [TransaksiController::class, 'plastik']); // kertas
    Route::post('/pemilik/dashboard/ambil/simpan/kaca', [TransaksiController::class, 'kaca']); // kertas
    Route::post('/pemilik/dashboard/ambil/simpan/logam', [TransaksiController::class, 'logam']); // kertas
    Route::post('/pemilik/dashboard/ambil/simpan/lainnya', [TransaksiController::class, 'lainnya']); // kertas

    // Simpan Antar
    Route::post('/pemilik/dashboard/antar/simpan', [TransaksiController::class, 'antarSendiri']); // Antar Sendiri

    // Ambil BuktiGambar
    Route::get('/pemilik/bukti/ambildirumah/{jenis}/{id}/{gambar}', [AmbilGambarController::class, 'showBuktiSampah']); //ambil bukti
    Route::get('/pemilik/bukti/antarsendiri/{id}/{gambar}', [AmbilGambarController::class, 'showBuktiKirim']); //ambil bukti
    Route::get('/pemilik/bukti/pembayaran/{id}/{gambar}', [AmbilGambarController::class, 'showBuktiPembayaran']); //ambil bukti
});

Route::middleware(['auth:pemilik','checkRole'])->group(function () {
    // Pilih Akun Controller
    Route::get('/pilih-akun', [PilihAkunController::class, 'pilihAkun']);
    Route::get('/login/loginPemilik', [LoginController::class, 'loginPemilik'])->name('loginPemilik');
    Route::post('/login/loginPengambil', [LoginController::class, 'loginPengambil'])->name('loginPengambil');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});


Route::middleware(['auth:pengambil'])->group(function () {
    // Pengambil Contrroller
    Route::get('/pengambil/dashboard', [DashboardController::class, 'dashboardPengambil']); // default pengambil
    Route::get('/pengambil/pembayaran', [DashboardController::class, 'pembayaranPengambil']); // Pembayaran Pengambil
    Route::get('/pengambil/riwayat', [DashboardController::class, 'riwayatPengambil']); // Riwayat Pengambil
    Route::get('/pengambil/dashboard/ambil', [DashboardController::class, 'ambilPengambil']); // halaman ambil pesanan

    // Ambil Pesanan
    Route::post('/pengambil/dashboard/ambil', [AmbilPengambilController::class, 'ambilPengambilSave']); // ambil pesanan
    Route::post('/pengambil/pembayaran/approved', [AmbilPengambilController::class, 'ambilPengambilSave']); // ambil pesanan
    Route::post('/pengambil/riwayat/terambil', [AmbilPengambilController::class, 'ambilPengambilSave']); // pesanan terambil

     // Ambil BuktiGambar
     Route::get('/pengambil/bukti/transaksi/{jenis}/{id}/{gambar}', [AmbilGambarController::class, 'showBuktiSampah']); //ambil bukti
     Route::get('/pengambil/bukti/pembayaran/{id}/{gambar}', [AmbilGambarController::class, 'showBuktiPembayaran']); //ambil bukti

});
