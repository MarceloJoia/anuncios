<?php

namespace App\Database\Seeds;

use App\Models\PlanModel;
use CodeIgniter\Config\Factories;
use CodeIgniter\Database\Seeder;

class PlanSeeder extends Seeder
{
    public function run()
    {
        try {
            $this->db->transStart();
            $planModel = Factories::models(PlanModel::class);

            foreach (self::plans() as $plan) {
                $planModel->insert($plan);
            }

            $this->db->transComplete();

            echo 'Planos criados com sucesso!';
        } catch (\Throwable $th) {

            log_message('error', '[ERROR] {exception}', ['exception' => $th]);

            print $th;
        }
    }


    private static function plans(): array
    {
        return [
            [
                'plan_id' => '11327',
                'name' => 'Plano mensal ',
                'recorrence' => 'monthly',
                'adverts' => '6',
                'description' => 'Planos mensal básico',
                'value' => '390.00',
                'is_highlighted' => '0',
            ],
            [
                'plan_id' => '11077',
                'name' => 'Plano Trimestral',
                'recorrence' => 'quarterly',
                'adverts' => '15',
                'description' => 'Plano trimestral',
                'value' => '1170.00',
                'is_highlighted' => '0',
            ],
            [
                'plan_id' => '11078',
                'name' => 'Plano semestral',
                'recorrence' => 'semester',
                'adverts' => '20',
                'description' => 'Plano semestral',
                'value' => '2340.00',
                'is_highlighted' => '1',
            ],
            [
                'plan_id' => '11079',
                'name' => 'Plano anual',
                'recorrence' => 'yearly',
                'adverts' => '25',
                'description' => 'Plano anual',
                'value' => '4680.00',
                'is_highlighted' => '0',
            ],
        ];
    }
}
