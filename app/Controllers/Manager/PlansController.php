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

    /**
     * Retorna a View de planos arquivados
     *
     * @return void
     */
    public function archived()
    {
        return view('Manager/Plans/archived');
    }


    public function getAllPlans()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        return $this->response->setJSON(['data' => $this->planService->getAllPlans()]);
    }


    public function getAllArchived()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        return $this->response->setJSON(['data' => $this->planService->getAllArchived()]);
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



    public function update()
    {
        $this->planRequest->validateBeforeSave('plan');

        $plan = $this->planService->getPlanByID($this->request->getGetPost('id'));

        $plan->fill($this->removeSpoofingFromRequest());

        $this->planService->trySavePlan($plan);

        return $this->response->setJSON($this->planRequest->respondWithMessage(message: lang('App.success_saved')));
    }



    public function archive()
    {
        $this->planService->tryArchivePlan($this->request->getGetPost('id'));

        return $this->response->setJSON($this->planRequest->respondWithMessage(message: lang('App.success_archived')));
    }




    public function getPlanInfo()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        };

        $response = [
            'plan'          => $plan = $this->planService->getPlanByID($this->request->getGetPost('id')),
            'recorrences'   => $this->planService->getRecorrences($plan->recorrence)
        ];

        return $this->response->setJSON($response);
    }






    public function getRecorrences()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        return $this->response->setJSON(['recorrences' => $this->planService->getRecorrences()]);
    }
}
