<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserEmailModel;
use App\Models\UserPengambilModel;

class GantiInformasiAkunController extends Controller
{
    //Cek Password
    public function passwordCheck(Request $request)
    {
        $passwordCheck = $request->passwordCheck;
        if (password_verify($passwordCheck, Auth::user()->password)) {
            return response()->json(['success' => 'Password Sama']);
        } else {
            return response()->json(['error' => 'Password Tidak Sama']);
        }
    }

    public function gantiDataAkunPemilik(Request $request)
    {
        $namaAkun = $request->nama;
        $nomor = $request->nomor;
        $oldPassword = $request->oldPassword;
        $password = $request->password;
        $user = UserEmailModel::find(Auth::id());
        if ($oldPassword === $password) {
            $user->name = $namaAkun;
            $user->nomor = $nomor;
            $user->save();
        } else {
            $user->name = $namaAkun;
            $user->nomor = $nomor;
            $user->password = bcrypt($password);
            $user->save();
        }
        return response()->json(['successGanti' => 'Ganti Data Berhasil']);
    }

    public function gantiDataPemilik(Request $request)
    {
        $nama = $request->nama;
        $alamat = $request->alamat;
        $kecamatan = $request->kecamatan;
        $kota = $request->kota;
        $provinsi = $request->provinsi;
        $kodePos = $request->kodePos;
        $catatan = $request->catatan;

        $user = UserEmailModel::find(Auth::id());

        $user->namaLengkap = $nama;
        $user->alamat = $alamat;
        $user->kecamatan = $kecamatan;
        $user->kota = $kota;
        $user->provinsi = $provinsi;
        $user->kodePos = $kodePos;
        $user->catatan = $catatan;
        $user->save();

        return response()->json(['successGanti' => 'Ganti Data Berhasil']);
    }
    public function daftarPengambil(Request $request)
    {
        $nama = $request->nama;
        $nomor = $request->nomor;
        $alamat = $request->alamat;
        $kecamatan = $request->kecamatan;
        $kota = $request->kota;
        $provinsi = $request->provinsi;
        $kodePos = $request->kodePos;
        $catatan = $request->catatan;
        $berat = $request->kapasitas;
        $atasNamaBank = $request->atasNamaBank;
        $bank = $request->bank;
        $norek = $request->norek;
        $ewallet = $request->ewallet;
        $namaewallet = $request->namaewallet;
        $noewallet = $request->noewallet;

        $user = UserEmailModel::find(Auth::id());
        $pengambil = new UserPengambilModel;

        $pengambil->name = $user->name;
        $pengambil->email = $user->email;
        $pengambil->berat = $berat;
        $pengambil->namaLengkap = $nama;
        $pengambil->nomor = $nomor;
        $pengambil->alamat = $alamat;
        $pengambil->kecamatan = $kecamatan;
        $pengambil->kota = $kota;
        $pengambil->provinsi = $provinsi;
        $pengambil->kodePos = $kodePos;
        $pengambil->catatan = $catatan;
        $pengambil->atasNamaBank = $atasNamaBank;
        $pengambil->bank = $bank;
        $pengambil->norek = $norek;
        $pengambil->ewallet = $ewallet;
        $pengambil->namaewallet = $namaewallet;
        $pengambil->noewallet = $noewallet;
        $pengambil->save();

        return response()->json(['successGanti' => 'Mendaftar Menjadi Agen Berhasil']);
    }
}
