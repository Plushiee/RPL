<?php

namespace App\Http\Controllers;

use App\Models\UserTransaksiBankModel;
use Illuminate\Http\Request;
use App\Models\UserEmailModel;
use Illuminate\Support\Facades\Auth;
use App\Models\UserTransaksiModel;

class DashboardController extends Controller
{
    public function dashboard() {
        return view('dashboard-pemilik');
    }

    public function ambil() {
        return view('ambil-pemilik');

    }
    public function antar() {
        return view('antar-pemilik');
    }

    public function akun() {
        return view('akun-pemilik');
    }

    public function riwayat() {
        $kumpulanTransaksi = UserTransaksiModel::where('idPemilik', Auth::id())->orderBy('id', 'desc')->get();
        $kumpulanBank = UserTransaksiBankModel::where('idPemilik', Auth::id())->orderBy('id', 'desc')->get();
        return view('riwayat-pemilik', [
            'kumpulanTransaksi' => $kumpulanTransaksi,
            'kumpulanBank' => $kumpulanBank,
        ]);
    }

    public function simpanAkunAwal(Request $request) {
        $user = UserEmailModel::find(Auth::id());
        $user->namaLengkap = $request->input('namaLengkap');
        $user->nomor = $request->input('nomor');
        $user->alamat = $request->input('alamat');
        $user->kecamatan = $request->input('kecamatan');
        $user->kota = $request->input('kota');
        $user->provinsi = $request->input('provinsi');
        $user->kodePos = $request->input('kodePos');
        $user->catatan = $request->input('catatan');
        $user->baru = false;
        $user->save();
    }
}
