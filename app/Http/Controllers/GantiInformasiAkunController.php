<?php

namespace App\Http\Controllers;

use App\Models\UserBankSampahModel;
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
    public function gantiDataAkunPengambil(Request $request)
    {
        $namaAkun = $request->nama;
        $nomor = $request->nomor;
        $oldPassword = $request->oldPassword;
        $password = $request->password;
        $user = UserEmailModel::where('email', Auth::user()->email)->first();
        $pengambil = UserPengambilModel::find(Auth::id());
        if ($oldPassword === $password) {
            $pengambil->name = $namaAkun;
            $pengambil->nomor = $nomor;
            $pengambil->save();
            $user->name = $namaAkun;
            $user->nomor = $nomor;
            $user->save();
        } else {
            $user->name = $namaAkun;
            $user->nomor = $nomor;
            $user->password = bcrypt($password);
            $user->save();
            $pengambil->name = $namaAkun;
            $pengambil->nomor = $nomor;
            $pengambil->save();
        }
        return response()->json(['successGanti' => 'Ganti Data Berhasil']);
    }

    public function gantiDataPemilikPengambil(Request $request)
    {
        $nama = $request->nama;
        $alamat = $request->alamat;
        $kecamatan = $request->kecamatan;
        $kota = $request->kota;
        $provinsi = $request->provinsi;
        $kodePos = $request->kodePos;
        $catatan = $request->catatan;

        $pengambil = UserPengambilModel::find(Auth::id());

        $pengambil->namaLengkap = $nama;
        $pengambil->alamat = $alamat;
        $pengambil->kecamatan = $kecamatan;
        $pengambil->kota = $kota;
        $pengambil->provinsi = $provinsi;
        $pengambil->kodePos = $kodePos;
        $pengambil->catatan = $catatan;
        $pengambil->save();

        return response()->json(['successGanti' => 'Ganti Data Berhasil']);
    }

    public function simpanDataPengambil(Request $request)
    {
        $berat = $request->berat;
        $atasNamaBank = $request->atasNamaBank;
        $bank = $request->bank;
        $norek = $request->norek;
        $ewallet = $request->ewallet;
        $namaewallet = $request->namaewallet;
        $noewallet = $request->noewallet;

        $pengambil = UserPengambilModel::find(Auth::id());

        $pengambil->berat = $berat;
        $pengambil->atasNamaBank = $atasNamaBank;
        $pengambil->bank = $bank;
        $pengambil->norek = $norek;
        $pengambil->ewallet = $ewallet;
        $pengambil->namaewallet = $namaewallet;
        $pengambil->noewallet = $noewallet;
        $pengambil->save();

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

        // isi data akun
        $pengambil->idUserMail = Auth::id();
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

    public function gantiDataAkunBank(Request $request)
    {
        $password = $request->password;
        $user = UserEmailModel::where('email', Auth::user()->email)->first();

        $user->password = bcrypt($password);
        $user->save();
        return response()->json(['successGanti' => 'Ganti Data Berhasil']);
    }

    public function simpanDataBank(Request $request)
    {
        $name = $request->nama;
        $nomor = $request->nomor;
        $alamat = $request->alamat;
        $kecamatan = $request->kecamatan;
        $kota = $request->kota;
        $provinsi = $request->provinsi;
        $kodePos = $request->kodePos;
        $catatan = $request->catatan;
        $kapasitas = $request->kapasitas;
        $lang = $request->lang;
        $long = $request->long;

        $bankSampah = UserBankSampahModel::find(Auth::id());

        $bankSampah->name = $name;
        $bankSampah->nomor = $nomor;
        $bankSampah->alamat = $alamat;
        $bankSampah->kecamatan = $kecamatan;
        $bankSampah->kota = $kota;
        $bankSampah->provinsi = $provinsi;
        $bankSampah->kodePos = $kodePos;
        $bankSampah->catatan = $catatan;
        $bankSampah->kapasitas = $kapasitas;
        $bankSampah->lang = $lang;
        $bankSampah->long = $long;

        $bankSampah->save();

        return response()->json(['successGanti' => 'Mendaftar Menjadi Agen Berhasil']);
    }

    public function daftarBank(Request $request)
    {
        $name = $request->name;
        $nomor = $request->nomor;
        $alamat = $request->alamat;
        $kecamatan = $request->kecamatan;
        $kota = $request->kota;
        $provinsi = $request->provinsi;
        $kodePos = $request->kodePos;
        $catatan = $request->catatan;
        $kapasitas = $request->kapasitas;
        $lang = $request->lang;
        $long = $request->long;

        $user = UserEmailModel::find(Auth::id());
        $bankSampah = new UserBankSampahModel;

        // isi data akun
        $bankSampah->idUserMail = Auth::id();
        $bankSampah->name = $name;
        $bankSampah->email = $user->email;
        $bankSampah->nomor = $nomor;
        $bankSampah->alamat = $alamat;
        $bankSampah->kecamatan = $kecamatan;
        $bankSampah->kota = $kota;
        $bankSampah->provinsi = $provinsi;
        $bankSampah->kodePos = $kodePos;
        $bankSampah->catatan = $catatan;
        $bankSampah->kapasitas = $kapasitas;
        $bankSampah->lang = $lang;
        $bankSampah->long = $long;

        $bankSampah->save();

        return response()->json(['successGanti' => 'Mendaftar Menjadi Agen Berhasil']);
    }
}
