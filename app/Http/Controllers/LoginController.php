<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserEmailModel;
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
                Auth::login($user, $remember);
                return redirect('/pemilik/dashboard');
            } else {
                return back()->with("errorWrong", "Email atau Password anda salah");
            }
        } else {

            // Jika login gagal, tampilkan pesan kesalahan
            return back()->with("error", "Email tidak terdaftar");
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
