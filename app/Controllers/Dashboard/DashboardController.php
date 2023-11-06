<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Requests\UserRequest;
use App\Services\GerencianetService;
use App\Services\UserService;
use CodeIgniter\Config\Factories;

class DashboardController extends BaseController
{
    private $user;
    private $userRequest;
    private $userService;
    private $gerencianetService;

    public function __construct()
    {
        $this->user                 = service('auth')->user();
        $this->userRequest          = Factories::class(UserRequest::class);
        $this->userService          = Factories::class(UserService::class);
        $this->gerencianetService   = Factories::class(GerencianetService::class);
    }


    public function index()
    {
        return view('Dashboard/Home/index');
    }


    public function profile()
    {
        $data = [
            'hiddens' => ['id' => $this->user->id, '_method' => 'PUT']
        ];

        return view('Dashboard/Home/profile', $data);
    }




    public function updateProfile()
    {

        
        $this->userRequest->validateBeforeSave('user_profile', respondWithRedirect: true);
        
        // $this->userService->tryUpdateProfile($this->removeSpoofingFromRequest());
        dd($this->removeSpoofingFromRequest());
        
        // if (session()->has('choice')) {

        //     return redirect()->to(session('choice'));
        // }


        // return redirect()->back()->with('success', lang('App.success_saved'));
    }
}
