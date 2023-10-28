<?php

namespace App\Controllers\Manager;

use App\Controllers\BaseController;
use App\Services\PlanService;
use CodeIgniter\Config\Factories;

class PlansController extends BaseController
{

    private $planService;

    public function __construct()
    {
        $this->planService = Factories::class(PlanService::class);
    }



    public function index()
    {
        return view('Manager/Plans/index');
    }




    public function getAllPlans()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        return $this->response->setJSON(['data' => $this->planService->getAllPlans()]);
    }


    public function getRecorrences()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        return $this->response->setJSON(['recorrences' => $this->planService->getRecorrences()]);
    }

    
}
