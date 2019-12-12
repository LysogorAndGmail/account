<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicPageController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function loginRegister()
    {
        return view('login');
    }
}
