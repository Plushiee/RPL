<?php

namespace App\Http\Controllers;

use App\Models\PengumumanBankModel;
use App\Models\PengumumanModel;
use App\Models\UserTransaksiBankModel;
use Illuminate\Http\Request;
use App\Models\UserEmailModel;
use Illuminate\Support\Facades\Auth;
use App\Models\UserTransaksiModel;
use App\Models\UserBankSampahModel;
use App\Models\UserPengambilModel;

class DashboardController extends Controller
{
    private $hitungBelumTerbayar;
    private $hitungPermintaanAprrove;
    private $hitungTransaksiBerjalan;
    private $hitungTransaksiBerjalanPemilik;
    private $hitungTransaksiBank;

    private function getCount()
    {
        $this->hitungBelumTerbayar = UserTransaksiModel::where('idPemilik', Auth::id())
            ->where('terbayar', false)->where('diterima', true)
            ->count();
        $this->hitungTransaksiBerjalanPemilik = UserTransaksiModel::where('idPemilik', Auth::id())
            ->where('terbayar', true)->where('diterima', true)
            ->count();
    }

    private function getCountPengambil()
    {
        $this->hitungPermintaanAprrove = UserTransaksiModel::where('idPengambil', Auth::id())
            ->where('terbayar', true)->where('approved', false)
            ->count();
        $this->hitungTransaksiBerjalan = UserTransaksiModel::where('idPengambil', Auth::id())
            ->where('diterima', true)->where('terambil', false)
            ->count();
    }

    private function getCountBank()
    {
        $this->hitungTransaksiBank = UserTransaksiBankModel::where('idBank', Auth::id())
            ->where('terambil', true)->where('terantar', false)
            ->count();
    }

    // Pemilik
    public function dashboard()
    {
        $this->getCount();
        $daftarPengumuman = PengumumanModel::join('user_transaksi', 'pengumuman.idPengambil', '=', 'user_transaksi.idPengambil')
            ->where('user_transaksi.idPemilik', Auth::user()->id)
            ->where('user_transaksi.diterima', true)
            ->where('pengumuman.aktif', true)
            ->orderBy('pengumuman.id', 'desc')
            ->get(['pengumuman.*']);
        return view('dashboard-pemilik', [
            'daftarPengumuman' => $daftarPengumuman,
            'hitungBelumTerbayar' => $this->hitungBelumTerbayar,
            'hitungTransaksiBerjalanPemilik' => $this->hitungTransaksiBerjalanPemilik
        ]);
    }

    public function ambil()
    {
        $this->getCount();
        $daftarPengumuman = PengumumanModel::join('user_transaksi', 'pengumuman.idPengambil', '=', 'user_transaksi.idPengambil')
            ->where('user_transaksi.idPemilik', Auth::user()->id)
            ->where('user_transaksi.diterima', true)
            ->where('pengumuman.aktif', true)
            ->orderBy('pengumuman.id', 'desc')
            ->get(['pengumuman.*']);
        return view('ambil-pemilik', [
            'daftarPengumuman' => $daftarPengumuman,
            'hitungBelumTerbayar' => $this->hitungBelumTerbayar,
            'hitungTransaksiBerjalanPemilik' => $this->hitungTransaksiBerjalanPemilik
        ]);

    }
    public function antar()
    {
        $this->getCount();
        $daftarPengumuman = PengumumanBankModel::join('banksampahmail', 'pengumuman_bank.idBank', '=', 'banksampahmail.id')
            ->where('pengumuman_bank.aktif', true)
            ->orderBy('pengumuman_bank.id', 'desc')
            ->get();
        return view('antar-pemilik', [
            'daftarPengumuman' => $daftarPengumuman,
            'hitungBelumTerbayar' => $this->hitungBelumTerbayar,
            'hitungTransaksiBerjalanPemilik' => $this->hitungTransaksiBerjalanPemilik
        ]);
    }

    public function akun()
    {
        $this->getCount();
        $isPengambil = UserPengambilModel::where('email', Auth::user()->email)->exists();
        $isBank = UserBankSampahModel::where('email', Auth::user()->email)->exists();
        return view('akun-pemilik', [
            'hitungBelumTerbayar' => $this->hitungBelumTerbayar,
            'hitungTransaksiBerjalanPemilik' => $this->hitungTransaksiBerjalanPemilik,
            'bank' => $isBank,
            'pengambil' => $isPengambil,
        ]);
    }

    public function riwayat()
    {
        $this->getCount();
        $kumpulanBank = UserTransaksiBankModel::join('banksampahmail', 'transaksi_bank.idBank', '=', 'banksampahmail.id')
            ->where('transaksi_bank.idPemilik', Auth::id())
            ->orderBy('transaksi_bank.id', 'desc')
            ->get(['transaksi_bank.*', 'banksampahmail.name', 'banksampahmail.email', 'banksampahmail.nomor', 'banksampahmail.alamat', 'banksampahmail.kecamatan', 'banksampahmail.kota', 'banksampahmail.provinsi', 'banksampahmail.kodePos', 'banksampahmail.catatan', 'banksampahmail.lang', 'banksampahmail.long']);

        $kumpulanTransaksi = UserTransaksiModel::where('idPemilik', Auth::id())->orderBy('id', 'desc')->get();
        return view('riwayat-pemilik', [
            'kumpulanTransaksi' => $kumpulanTransaksi,
            'kumpulanBank' => $kumpulanBank,
            'hitungBelumTerbayar' => $this->hitungBelumTerbayar,
            'hitungTransaksiBerjalanPemilik' => $this->hitungTransaksiBerjalanPemilik
        ]);
    }

    public function pembayaran()
    {
        $this->getCount();
        $kumpulanTransaksi = UserTransaksiModel::where('idPemilik', Auth::id())->where('diterima', true)->orderBy('id', 'desc')->get();
        return view('pembayaran-pemilik', [
            'kumpulanTransaksi' => $kumpulanTransaksi,
            'hitungBelumTerbayar' => $this->hitungBelumTerbayar,
            'hitungTransaksiBerjalanPemilik' => $this->hitungTransaksiBerjalanPemilik
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
        $this->getCountPengambil();
        $daftarPengumuman = PengumumanModel::where('idPengambil', Auth::user()->id)
            ->where('aktif', true)->orderBy('id', 'desc')
            ->get();
        return view('dashboard-pengambil', [
            'daftarPengumuman' => $daftarPengumuman,
            'hitungPermintaanAprrove' => $this->hitungPermintaanAprrove,
            'hitungTransaksiBerjalan' => $this->hitungTransaksiBerjalan
        ]);
    }

    public function ambilPengambil()
    {
        $this->getCountPengambil();

        $userBerat = Auth::user()->berat;

        $allowedBerat = [];

        if ($userBerat == 'medium') {
            $allowedBerat = ['medium', 'small'];
        } elseif ($userBerat == 'small') {
            $allowedBerat = ['small'];
        } elseif ($userBerat == 'large') {
            $allowedBerat = ['medium', 'small', 'large'];
        }

        $kumpulanTransaksi = UserTransaksiModel::orderBy('id', 'desc')
            ->whereIn('berat', $allowedBerat)
            ->where('diterima', false)
            ->where('idPemilik', '!=', Auth::id())
            ->get();

        return view('ambil-pengambil', [
            'kumpulanTransaksi' => $kumpulanTransaksi,
            'hitungPermintaanAprrove' => $this->hitungPermintaanAprrove,
            'hitungTransaksiBerjalan' => $this->hitungTransaksiBerjalan
        ]);
    }

    public function riwayatPengambil()
    {
        $this->getCountPengambil();
        $kumpulanTransaksi = UserTransaksiModel::orderBy('id', 'desc')->where('diterima', true)->get();
        return view('riwayat-pengambil', [
            'kumpulanTransaksi' => $kumpulanTransaksi,
            'hitungPermintaanAprrove' => $this->hitungPermintaanAprrove,
            'hitungTransaksiBerjalan' => $this->hitungTransaksiBerjalan
        ]);
    }

    public function pengumumanPengambil()
    {
        $this->getCountPengambil();
        $daftarPengumuman = PengumumanModel::orderBy('id', 'desc')->where('idPengambil', Auth::id())->get();
        $hitungPengumumanAktif = PengumumanModel::where('idPengambil', Auth::id())->where('aktif', true)->count();
        return view('pengumuman-pengambil', [
            'daftarPengumuman' => $daftarPengumuman,
            'hitungPengumumanAktif' => $hitungPengumumanAktif,
            'hitungPermintaanAprrove' => $this->hitungPermintaanAprrove,
            'hitungTransaksiBerjalan' => $this->hitungTransaksiBerjalan
        ]);
    }

    public function pembayaranPengambil()
    {
        $this->getCountPengambil();
        $kumpulanTransaksi = UserTransaksiModel::orderBy('id', 'desc')->where('idPengambil', Auth::id())->where('diterima', true)->get();
        return view('pembayaran-pengambil', [
            'kumpulanTransaksi' => $kumpulanTransaksi,
            'hitungPermintaanAprrove' => $this->hitungPermintaanAprrove,
            'hitungTransaksiBerjalan' => $this->hitungTransaksiBerjalan
        ]);
    }

    public function akunPengambil()
    {
        $this->getCountPengambil();
        return view('akun-pengambil', [
            'hitungPermintaanAprrove' => $this->hitungPermintaanAprrove,
            'hitungTransaksiBerjalan' => $this->hitungTransaksiBerjalan
        ]);
    }

    // Bank Sampah
    public function dashboardBank()
    {

        return view('dashboard-bank', [

        ]);
    }

    public function terimaBank()
    {

        $kapasitas = Auth::user()->kapasitas;

        $allowedBerat = '';


        $kumpulanTransaksi = UserTransaksiBankModel::join('banksampahmail', 'transaksi_bank.idBank', '=', 'banksampahmail.id')
            ->where('transaksi_bank.diterima', false)
            ->where('transaksi_bank.idPemilik', '!=', Auth::id())
            ->orderBy('transaksi_bank.id', 'desc')
            ->get(['transaksi_bank.*', 'banksampahmail.name', 'banksampahmail.email', 'banksampahmail.nomor', 'banksampahmail.alamat', 'banksampahmail.kecamatan', 'banksampahmail.kota', 'banksampahmail.provinsi', 'banksampahmail.kodePos', 'banksampahmail.catatan', 'banksampahmail.lang', 'banksampahmail.long']);

        return view('terima-bank', [
            'kumpulanTransaksi' => $kumpulanTransaksi,
        ]);
    }

    public function riwayatBank()
    {
        $kumpulanTransaksi = UserTransaksiBankModel::join('banksampahmail', 'transaksi_bank.idBank', '=', 'banksampahmail.id')
            ->where('transaksi_bank.diterima', true)
            ->where('transaksi_bank.idBank', Auth::id())
            ->orderBy('transaksi_bank.id', 'desc')
            ->get(['transaksi_bank.*', 'banksampahmail.name', 'banksampahmail.email', 'banksampahmail.nomor', 'banksampahmail.alamat', 'banksampahmail.kecamatan', 'banksampahmail.kota', 'banksampahmail.provinsi', 'banksampahmail.kodePos', 'banksampahmail.catatan', 'banksampahmail.lang', 'banksampahmail.long']);

        return view('riwayat-bank', [
            'kumpulanTransaksi' => $kumpulanTransaksi,
        ]);
    }

    public function pengumumanBank()
    {
        // $this->getCountPengambil();
        $daftarPengumuman = PengumumanBankModel::orderBy('id', 'desc')->where('idBank', Auth::id())->get();
        $hitungPengumumanAktif = PengumumanBankModel::where('idBank', Auth::id())->where('aktif', true)->count();
        return view('pengumuman-bank', [
            'daftarPengumuman' => $daftarPengumuman,
            'hitungPengumumanAktif' => $hitungPengumumanAktif,
        ]);
    }

    public function akunBank()
    {
        // $this->getCountPengambil();
        return view('akun-bank', [
            // 'hitungPermintaanAprrove' => $this->hitungPermintaanAprrove,
            // 'hitungTransaksiBerjalan' => $this->hitungTransaksiBerjalan
        ]);
    }

}
