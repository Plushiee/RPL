<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserEmailModel;
use \App\Models\UserPengambilModel;
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
                $isPemilik = UserEmailModel::where('email', $email)->exists();
                $isPengambil = UserPengambilModel::where('email', $email)->exists();

                if ($isPemilik && $isPengambil) {
                    // Redirect to choose account type page
                    Auth::guard('pemilik')->login($userPemilik, $remember);
                    return redirect('/pilih-akun');
                }

                Auth::guard('pemilik')->login($userPemilik, $remember);
                return redirect('/pemilik/dashboard');

            } else {
                return back()->with("errorWrong", "Email atau Password anda salah");
            }
        } else {
            return back()->with("error", "Email tidak terdaftar");
        }
    }

    function loginPemilik(Request $request)
    {
        return redirect('/pemilik/dashboard');
    }

    function loginPengambil(Request $request)
    {
        $email = $request->email;
        $remember = $request->remember;
        $userPengambil = UserPengambilModel::where('email', $email)->first();
        // dd($userPengambil);
        Auth::guard('pemilik')->logout();
        Auth::guard('pengambil')->login($userPengambil, $remember);
        return redirect('/pengambil/dashboard');
    }

    public function logout()
    {
        Auth::guard('pemilik')->logout();
        return redirect('/login');
    }
}
