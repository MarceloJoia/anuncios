<?php

namespace App\Controllers;

use App\Requests\GerencianetRequest;
use App\Services\AdvertService;
use App\Services\GerencianetService;
use App\Services\PlanService;
use App\Services\UserService;
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
        $this->userService          = Factories::class(UserService::class);
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



    public function choice(int $planID = null)
    {
        //=> se ja existir uma assinatora será mandado para a home impedindo a nova assinatura
        // if ($this->gerencianetService->userHasSubscription()) {
        //     return redirect()->route('dashboard')->with('info', 'Você já possui uma Assinatura. Aproveite para cancelá-la e adquirir o novo Plano.');
        // }


        // dd($this->userService->userDataIsComplete());

        if (!$this->userService->userDataIsComplete()) {
            // usaremos para redirecionar após o user atualizar o perfil. Esse trecho é para o caso de o user ter logado antes de tentar comprar o Plano
            session()->set('choice', current_url());
            
            // return redirect()->route('profile')->with('info', service('auth')->user()->flashMessageToUser());
            return redirect()->route('profile')->with('info', 'Atualizar dados do perfil antes de comprar');
        }

        $plan = $this->planService->getChoosenPlan($planID);

        $data = [
            'title' => "Realizar o pagamento do Plano {$plan->name}",
            'plan'  => $plan
        ];

        return view('Web/Home/choice', $data);
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
