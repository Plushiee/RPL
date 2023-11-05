<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserGoogleModel;
use App\Models\UserEmailModel;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Google;

class RegisterController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function auth()
    {
        $client_id = "233436046340-3g8k1tar7j9evj6btbbgb7l9ak4637hn.apps.googleusercontent.com";
        $client_secret = "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";

        $client = new Google\Client();
        $client->setClientId($client_id);
        $client->setClientSecret($client_secret);

        $redirect_uri = 'https://rpl.plushiee.my.id/login';
        $client->setRedirectUri($redirect_uri);
        $client->addScope("email");
        $client->addScope("profile");
    }

    public function email(Request $request) {
        $email = $request->input("emailRegister");
        $userEmail = UserEmailModel::where("email", $email)->first();
        $username = UserEmailModel::where("email", $email)->first();
        $newUser = new UserEmailModel;
        if (!$userEmail && !$username) {
            $newUser->name = $request->namaRegister;
            $newUser->email = $request->emailRegister;
            $newUser->password = bcrypt($request->passwordRegister);
            $newUser->status = 'pemilik';
            $newUser->baru = true;
            $newUser->save();
            return redirect()->route('login')->with("success","Pendaftaran Berhasil");
        } else {
            return redirect()->back()->with("error","Email atau Nama sudah terdaftar");

        }
    }
}
