<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        return view('Dashboard/Home/index');
    }
}
