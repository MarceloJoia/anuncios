<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GeneralSeeder extends Seeder
{
    public function run()
    {
        $this->call(SuperadminSeeder::class);

        $this->call(PlanSeeder::class);

        //$this->call(UserSeeder::class);

        //$this->call(CategorySeeder::class);

        //$this->call(AdvertSeeder::class); // comento esse para usar o meu AdvertsWithImages que já está todo atualizado

        //$this->call(AdvertsWithImages::class);

        //$this->call(SubscriptionSeeder::class); // criado em OFF.... o aluno sabe como fazer
    }
}
