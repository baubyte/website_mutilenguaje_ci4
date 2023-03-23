<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMaintenanceTable extends Migration
{
    public function up()
    {
		$this->forge->addField([
            'id'         => [
                'type'              => 'int',
                'constraint'        => 11,
                'unsigned'          => true,
                'auto_increment'    => true
            ],
			'status'     => [
                'type'              => 'int',
                'constraint'        => 1,
                'null'              => false,
                'default'           => 0
            ],
		]);

        $this->forge->addKey('id', true);
		$this->forge->createTable('maintenance', true);
    }

    public function down()
    {
		$this->forge->dropTable('maintenance', true);
    }
}
