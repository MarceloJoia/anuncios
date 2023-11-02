<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableAdvertsImages extends Migration
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
            'advert_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'image'       => [
                'type'       => 'VARCHAR',
                'constraint' => '240',
            ],
        ]);
        $this->forge->addKey('id', true); // primary key        
        $this->forge->addForeignKey('advert_id', 'adverts', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('adverts_images');
    }

    public function down()
    {
        $this->forge->dropTable('adverts_images');
    }
}
