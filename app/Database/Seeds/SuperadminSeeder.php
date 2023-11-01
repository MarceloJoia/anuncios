<?php

namespace App\Database\Seeds;

use App\Entities\User;
use App\Models\UserModel;
use CodeIgniter\Config\Factories;
use CodeIgniter\Database\Seeder;

class SuperadminSeeder extends Seeder
{
    public function run()
    {
        try {
            $this->db->transStart();

            $user = new User([
                'username'             => 'Marcelo',
                // 'name'                 => 'Marcelo', // alteraremos
                // 'last_name'            => 'Joia', // alteraremos
                'email'                => 'sitejoia@hotmail.com',
                'password'             => 'zaq1xsw2',
                'email_verified_at'    => date('Y-m-d H:i:s'), // já criamos com a conta verificada (email)
            ]);

            $userID = Factories::models(UserModel::class)->insert($user);
            
            $this->createSuperadmin($userID);

            $this->db->transComplete();
            
            echo "Superadmin criado com sucesso!";
        } catch (\Exception $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $th]);
            print $e->getMessage();
        }
    }


    private function createSuperadmin(int $userID)
    {
        $db = \Config\Database::connect();

        $superadmin = [
            'user_id' => $userID
        ];

        $db->table('superadmins')->insert($superadmin);
    }
}
