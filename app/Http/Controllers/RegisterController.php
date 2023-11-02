<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserGoogleModel;
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
        // require('./vendor/autoload.php');

        # Add your client ID and Secret
        $client_id = "233436046340-3g8k1tar7j9evj6btbbgb7l9ak4637hn.apps.googleusercontent.com";
        $client_secret = "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";

        $client = new Google\Client();
        $client->setClientId($client_id);
        $client->setClientSecret($client_secret);

        # redirection location is the path to login.php
        $redirect_uri = './login';
        $client->setRedirectUri($redirect_uri);

        var_dump($client);

        $login_url = $client->createAuthUrl();
    }

    private function getGoogleUser($code)
    {
        try {
            // Menggunakan Laravel Socialite untuk mengambil data pengguna dari Google OAuth
            $user = Socialite::driver('google')->stateless()->user();

            // Anda dapat mengakses informasi pengguna seperti ID, email, nama, gambar profil, dll.
            $googleUser = [
                'id' => $user->getId(),
                'email' => $user->getEmail(),
                'name' => $user->getName(),
                'picture' => $user->getAvatar(),
            ];

            return $googleUser;
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            return null;
        }
    }
}
