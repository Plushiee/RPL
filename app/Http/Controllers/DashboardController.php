<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserEmailModel;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard() {
        return view('dashboard-pemilik');
    }

    public function ambil() {
        return view('ambil-pemilik');
    }

    public function akun() {
        return view('akun-pemilik');
    }

    public function simpanAkunAwal(Request $request) {
        $user = UserEmailModel::find(Auth::id());
        $user->namaLengkap = $request->input('nama');
        $user->nomor = $request->input('nomor');
        $user->alamat = $request->input('alamat');
        $user->kecamatan = $request->input('kecamatan');
        $user->kota = $request->input('kota');
        $user->provinsi = $request->input('provinsi');
        $user->kodePos = $request->input('kodePos');
        $user->catatan = $request->input('catatan');
        $user->status = false;
        $user->save();
    }
}
