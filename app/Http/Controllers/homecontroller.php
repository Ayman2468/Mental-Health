<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Auth;

class homecontroller extends Controller
{
    //
    public function index()
    {
        return view('home');
    }
}
