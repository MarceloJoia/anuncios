<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableSuperadmins extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
        ]);
        $this->forge->addKey('id', true); // primary key
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('superadmins');
    }
    public function down()
    {
        $this->forge->dropTable('superadmins');
    }
}
