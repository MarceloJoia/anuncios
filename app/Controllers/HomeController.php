<?php

namespace App\Controllers;

use App\Requests\GerencianetRequest;
use App\Services\AdvertService;
use App\Services\GerencianetService;
use App\Services\PlanService;
use CodeIgniter\Config\Factories;

class HomeController extends BaseController
{
    private $planService;
    private $userService;
    private $gerencianetRequest;
    private $gerencianetService;
    private $advertService;
    
    public function __construct()
    {
        $this->planService          = Factories::class(PlanService::class);
        // $this->userService          = Factories::class(UserService::class);
        $this->gerencianetRequest   = Factories::class(GerencianetRequest::class);
        $this->gerencianetService   = Factories::class(GerencianetService::class);
        $this->advertService        = Factories::class(AdvertService::class);
    }

    public function index()
    {
        $data = [
            'title' => 'Anúcios recentes',
        ];
        return view('Web/Home/index', $data);
    }


    /**
     * Exibe os planos na home do site
     *
     * @return void
     */
    public function pricing()
    {
        $data = [
            'title' => 'Venda mais! Conheça nossos planos',
            'plans' => $this->planService->getPlansToSell()
        ];

        return view('Web/Home/pricing', $data);
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
