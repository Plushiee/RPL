<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PilihAkunController extends Controller
{
    public function pilihAkun() {
        return view('pilih-akun');
    }
}
