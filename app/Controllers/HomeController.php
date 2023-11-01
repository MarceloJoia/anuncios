<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Anúcios recentes',
        ];
        return view('Web/Home/index', $data);
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
