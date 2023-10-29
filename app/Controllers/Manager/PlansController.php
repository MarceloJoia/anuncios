<?php

namespace App\Controllers\Manager;

use App\Controllers\BaseController;
use App\Entities\Plan;
use App\Requests\PlanRequest;
use App\Services\PlanService;
use CodeIgniter\Config\Factories;

class PlansController extends BaseController
{

    private $planService;
    private $planRequest;

    public function __construct()
    {
        $this->planService = Factories::class(PlanService::class);
        $this->planRequest = Factories::class(PlanRequest::class);
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

    /**
     * Cria um novo Plano
     *
     * @return void
     */
    public function create()
    {
        $this->planRequest->validateBeforeSave('plan');

        //=> Criar o plano
        $plan = new Plan($this->removeSpoofingFromRequest());
        $this->planService->trySavePlan($plan);
        return $this->response->setJSON($this->planRequest->respondWithMessage(message: lang('App.success_saved')));
    }



    public function getRecorrences()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        return $this->response->setJSON(['recorrences' => $this->planService->getRecorrences()]);
    }
}
