<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserEmailModel;

class GantiInformasiAkunController extends Controller
{
    //Cek Password
    public function passwordCheck (Request $request) {
        $passwordCheck = $request->passwordCheck;
        if (password_verify($passwordCheck, Auth::user()->password)) {
            return response()->json(['success' => 'Password Sama']);
        } else {
            return response()->json(['error' => 'Password Tidak Sama']);
        }
    }

    public function gantiDataAkunPemilik (Request $request) {
        $namaAkun = $request->nama;
        $nomor = $request->nomor;
        $oldPassword = $request->oldPassword;
        $password = $request->password;
        $user = UserEmailModel::find(Auth::id());
        if($oldPassword === $password) {
            $user->name = $namaAkun;
            $user->nomor = $nomor;
            $user->save();
        } else {
            $user->name = $namaAkun;
            $user->nomor = $nomor;
            $user->password = bcrypt($password);
            $user->save();
        }
        return response()->json(['successGanti'=> 'Ganti Data Berhasil']);
    }

    public function gantiDataPemilik (Request $request) {
        $namaAkun = $request->nama;
        $nomor = $request->nomor;
        $oldPassword = $request->oldPassword;
        $password = $request->password;
        $user = UserEmailModel::find(Auth::id());
        if($oldPassword === $password) {
            $user->name = $namaAkun;
            $user->nomor = $nomor;
            $user->save();
        } else {
            $user->name = $namaAkun;
            $user->nomor = $nomor;
            $user->password = bcrypt($password);
            $user->save();
        }
        return response()->json(['successGanti'=> 'Ganti Data Berhasil']);
    }
}
