<?php

namespace App\Http\Controllers;

use App\Models\UserTransaksiBankModel;
use Illuminate\Http\Request;
use App\Models\UserEmailModel;
use Illuminate\Support\Facades\Auth;
use App\Models\UserTransaksiModel;

class DashboardController extends Controller
{
    private $hitungBelumTerbayar;

    private function getCount()
    {
        $this->hitungBelumTerbayar = UserTransaksiModel::where('idPemilik', Auth::id())
            ->where('terbayar', false)
            ->count();
    }

    // Pemilik
    public function dashboard()
    {
        $this->getCount();
        return view('dashboard-pemilik', ['hitungBelumTerbayar' => $this->hitungBelumTerbayar]);
    }

    public function ambil()
    {
        $this->getCount();
        return view('ambil-pemilik', ['hitungBelumTerbayar' => $this->hitungBelumTerbayar]);

    }
    public function antar()
    {
        $this->getCount();
        return view('antar-pemilik', ['hitungBelumTerbayar' => $this->hitungBelumTerbayar]);
    }

    public function akun()
    {
        $this->getCount();
        return view('akun-pemilik', ['hitungBelumTerbayar' => $this->hitungBelumTerbayar]);
    }

    public function riwayat()
    {
        $this->getCount();
        $kumpulanBank = UserTransaksiBankModel::where('idPemilik', Auth::id())->orderBy('id', 'desc')->get();
        $kumpulanTransaksi = UserTransaksiModel::where('idPemilik', Auth::id())->orderBy('id', 'desc')->get();
        return view('riwayat-pemilik', [
            'kumpulanTransaksi' => $kumpulanTransaksi,
            'kumpulanBank' => $kumpulanBank,
            'hitungBelumTerbayar' => $this->hitungBelumTerbayar
        ]);
    }

    public function pembayaran()
    {
        $this->getCount();
        $kumpulanTransaksi = UserTransaksiModel::where('idPemilik', Auth::id())->orderBy('id', 'desc')->get();
        return view('pembayaran-pemilik', [
            'kumpulanTransaksi' => $kumpulanTransaksi,
            'hitungBelumTerbayar' => $this->hitungBelumTerbayar
        ]);
    }

    public function simpanAkunAwal(Request $request)
    {
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

    // Pengambil
    public function dashboardPengambil()
    {
        $this->getCount();
        return view('dashboard-pengambil');
    }

    public function ambilPengambil()
    {
        $this->getCount();
        $kumpulanTransaksi = UserTransaksiModel::orderBy('id', 'desc')->get();
        return view('ambil-pengambil', [
            'kumpulanTransaksi' => $kumpulanTransaksi,
            'hitungBelumTerbayar' => $this->hitungBelumTerbayar
        ]);
    }
}
