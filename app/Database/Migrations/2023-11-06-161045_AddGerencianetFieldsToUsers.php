<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddGerencianetFieldsToUsers extends Migration
{
    public function up()
    {
        $fields = [

            'name' => [
                'type'                  => 'VARCHAR',
                'constraint'            => '30',
                'null'                  => true,
            ],
            'last_name' => [
                'type'                  => 'VARCHAR',
                'constraint'            => '50',
                'null'                  => true,
            ],
            'cpf' => [
                'type'                  => 'VARCHAR',
                'constraint'            => '20',
                'null'                  => true,
            ],
            'birth' => [
                'type'                  => 'DATE',
                'null'                  => true,
            ],
            'phone' => [
                'type'                  => 'VARCHAR',
                'constraint'            => '20',
                'null'                  => true,
            ],
            'display_phone' => [
                'type'                  => 'BOOLEAN',
                'default'               => true,
            ],
        ];

        $this->forge->addColumn('users', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'name');
        $this->forge->dropColumn('users', 'last_name');
        $this->forge->dropColumn('users', 'cpf');
        $this->forge->dropColumn('users', 'birth');
        $this->forge->dropColumn('users', 'phone');
        $this->forge->dropColumn('users', 'display_phone');
    }
}
