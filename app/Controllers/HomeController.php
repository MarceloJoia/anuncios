<?php

namespace App\Controllers;


use App\Services\PlanService;
use App\Services\UserService;
use CodeIgniter\Config\Factories;

class HomeController extends BaseController
{
    private $planService;
    private $userService;



    public function __construct()
    {
        $this->planService          = Factories::class(PlanService::class);
        $this->userService          = Factories::class(UserService::class);
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

        // dd($this->userService->userDataIsComplete());
        
        // if (!$this->userService->userDataIsComplete()) {
        //     // usaremos para redirecionar após o user atualizar o perfil. Esse trecho é para o caso de o user ter logado antes de tentar comprar o Plano
        //     session()->set('choice', current_url());
            
        //     return redirect()->route('profile')->with('info', 'Atualizar dados do perfil antes de comprar');
        // }
        
        $plan = $this->planService->getChoosenPlan($planID);

        // dd($plan);

        $data = [
            'title' => "Realizar o pagamento do Plano {$plan->name}",
            'plan'  => $plan
        ];

        return view('Web/Home/choice', $data);
    }

}
