<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //Login Page

    public function login() {
        return view('login');
    }
}
