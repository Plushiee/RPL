<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserGoogleModel;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class RegisterController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function auth()
    {
        if (isset($_GET['access_token'])) {
            $code = $_GET['access_token'];

            $googleUser = $this->getGoogleUser($code);

            if (!$googleUser) {
                return 'Gagal mendapatkan token akses.';
            }

            // Cari pengguna berdasarkan Google ID
            $user = UserGoogleModel::where('google_id', $googleUser['id'])->first();

            if (!$user) {
                // Buat pengguna baru jika tidak ditemukan
                $user = new UserGoogleModel();
                $user->google_id = $googleUser['id'];
                $user->email = $googleUser['email'];
                $user->name = $googleUser['name'];
                $user->profile_picture = $googleUser['picture'];
                $user->save();
            }

            // Otentikasi pengguna di dalam Laravel
            Auth::login($user);

            return redirect('/pemilik/dashboard'); // Sesuaikan dengan rute dashboard Anda
        } else {
            return 'Kode otorisasi tidak ditemukan.';
        }
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
