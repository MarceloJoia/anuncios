<?php

namespace App\Services;

use App\Entities\Plan;
use App\Models\PlanModel;
use CodeIgniter\Config\Factories;


class PlanService
{
    private $planModel;

    public function __construct()
    {
        $this->planModel = Factories::models(PlanModel::class);
    }


    /**
     * Recupera todos os planos que está ativo no momento.
     *
     * @return array
     */
    public function getAllPlans(): array
    {
        $plans = $this->planModel->findAll();

        $data = [];
        foreach ($plans as $plan) {

            $btnEdit = form_button(
                [
                    'data-id'       => $plan->id,
                    'id'            => 'updatePlanBtn', //ID do HTML element
                    'class'         => 'btn btn-primary btn-sm'
                ],
                '<i class="bi bi-pencil-square"></i>&nbsp;' . lang('App.btn_edit')
            );

            $btnArchive = form_button(
                [
                    'data-id'       => $plan->id,
                    'id'            => 'archivePlanBtn', //ID do HTML element
                    'class'         => 'btn btn-warning btn-sm'
                ],
                '<i class="bi bi-archive-fill"></i>&nbsp;'  . lang('App.btn_archive')
            );
            $data[] = [
                'code'              => $plan->plan_id,
                'name'              => $plan->name,
                'is_highlighted'    => $plan->isHighlighted(),
                'details'           => $plan->details(),
                'actions'           => $btnEdit . ' ' . $btnArchive,
            ];
        }

        return $data;
    }

    public function getRecorrences(string $recorrence = null): string
    {
        $options    = [];
        $selected   = [];

        $options = [
            ''                          => lang('Plans.label_recorrence'), // option vazio
            Plan::OPTION_MONTHLY        => lang('Plans.text_monthly'),
            Plan::OPTION_QUARTERLY      => lang('Plans.text_quarterly'),
            Plan::OPTION_SEMESTER       => lang('Plans.text_semester'),
            Plan::OPTION_YEARLY         => lang('Plans.text_yearly'),
        ];

        // Estou criando um plano?
        if (is_null($recorrence)) {
            return form_dropdown('recorrence', $options, $selected, ['class' => 'form-control']);
        }

        // Estamos efetivamente editando um plano...

        // $selected[] = match ($recorrence) {

        //     Plan::OPTION_MONTHLY        => Plan::OPTION_MONTHLY,
        //     Plan::OPTION_QUARTERLY      => Plan::OPTION_QUARTERLY,
        //     Plan::OPTION_SEMESTER       => Plan::OPTION_SEMESTER,
        //     Plan::OPTION_YEARLY         => Plan::OPTION_YEARLY,
        //     default                     => throw new \InvalidArgumentException("Unsupported recorrence {$recorrence}")
        // };


        // return form_dropdown('recorrence', $options, $selected, ['class' => 'form-control']);
    }

    public function trySavePlan(Plan $plan, bool $protect = true)
    {
        try {
            // $this->createOrUpdatePlanOnGerencianet($plan);
            if ($plan->hasChanged()) {
                $this->planModel->protect($protect)->save($plan);
            }
        } catch (\Exception $e) {

            die($e->getMessage());
        }
    }

    // private function createOrUpdatePlanOnGerencianet(Plan $plan)
    // {
    //     // Estamos criando um plano?
    //     if (empty($plan->id)) {

    //         // Sim.. criamos o plano na gerencianet

    //         return $this->gerencianetService->createPlan($plan);
    //     }

    //     // Estamos atualizando....
    //     // Contudo, precisamo verificar se o nome do plano foi alterado.
    //     // a Gerencianet permite atualizar apenas o nome do plano.
    //     if ($plan->hasChanged('name')) {

    //         return $this->gerencianetService->updatePlan($plan);
    //     }
    // }

}
