<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index()
    {
        return view('Web/Home/index');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function confirm()
    {
        return 'granted password';
    }
}
