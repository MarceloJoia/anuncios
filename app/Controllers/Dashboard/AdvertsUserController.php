<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;


class AdvertsUserController extends BaseController
{

    public function index()
    {
        return view('Dashboard/Adverts/index');
    }

}
