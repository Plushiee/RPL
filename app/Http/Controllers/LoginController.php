<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\UserEmailModel;
use App\Models\UserPengambilModel;
use App\Models\UserBankSampahModel;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //Login Page

    public function login()
    {
        return view('login');
    }

    public function loginCheck(Request $request)
    {
        $email = $request->emailLogin;
        $password = $request->passwordLogin;
        $remember = $request->has('remember');

        $user = UserEmailModel::where('email', $email)->first();

        if ($user) {
            if (password_verify($password, $user->password)) {
                $userPemilik = UserEmailModel::where('email', $email)->first();
                Auth::guard('pemilik')->login($userPemilik, $remember);

                $isPemilik = UserEmailModel::where('email', $email)->exists();
                $isPengambil = UserPengambilModel::where('email', $email)->exists();
                $isBank = UserBankSampahModel::where('email', $email)->exists();

                if ($isPemilik && ($isPengambil || $isBank)) {
                    if ($isPengambil) {
                        return redirect('/pilih-akun')->with("pengambil", "User Ini Ada Pengambil");
                    }
                    if ($isBank) {
                        return redirect('/pilih-akun')->with("bank", "User Ini Ada Bank");
                    }

                } else {
                    return redirect('/pemilik/dashboard')->with("success", "Berhasil Login");
                }
            } else {
                return back()->with("errorWrong", "Email atau Password anda salah");
            }
        } else {
            return back()->with("error", "Email tidak terdaftar");
        }
    }

    public function loginPemilik(Request $request)
    {
        return redirect('/pemilik/dashboard');
    }

    public function loginPengambil(Request $request)
    {
        $email = $request->email;
        $remember = $request->remember;
        $userPengambil = UserPengambilModel::where('email', $email)->first();
        Auth::guard('pemilik')->logout();
        Auth::guard('pengambil')->login($userPengambil, $remember);
        return redirect('/pengambil/dashboard');
    }

    public function loginBank(Request $request)
    {
        $email = $request->email;
        $remember = $request->remember;
        $userBank = UserBankSampahModel::where('email', $email)->first();
        Auth::guard('pemilik')->logout();
        Auth::guard('bank')->login($userBank, $remember);
        return redirect('/bank/dashboard');
    }
    
    public function logout(Request $request)
    {
        $userTypes = ['pengambil', 'bank', 'pemilik'];

        // foreach ($userTypes as $userType) {
            // if (Auth::guard($userType)->check()) {
                // Auth::guard($userType)->logout();
            // }
        // }
        dd($userTypes);

        // return redirect('/login');
    }
}



