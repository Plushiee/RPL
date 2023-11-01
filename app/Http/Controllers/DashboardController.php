<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard() {
        return view('dashboard-pemilik');
    }

    public function ambil() {
        return view('ambil-pemilik');
    }

    public function akun() {
        return view('akun-pemilik');
    }
}
