<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DefaultController extends Controller
{
    //index
    public function index() {
        return view('index');
    }
}
