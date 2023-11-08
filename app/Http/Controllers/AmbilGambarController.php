<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AmbilGambarController extends Controller
{
    //Gambar Bukti Ambil Dirumah
    public function showBuktiSampah($jenis, $id, $gambar)
    {
        if (Auth::check()) {
            $path = "/$jenis/$id/$gambar";

            if (Storage::disk('secure_diRumah')->exists($path)) {
                // return response()->file(Storage::disk('secure_diRumah')->path($path));
                return response()->json(['message' => 'OK']);
            }
        }
        return response()->json(['message' => 'Definitely not OK ', 'path'=> $path]);
        // return response()->file(public_path('images/default.png'));
    }
}
