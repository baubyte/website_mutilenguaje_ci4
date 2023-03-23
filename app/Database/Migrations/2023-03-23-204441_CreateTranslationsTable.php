<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTranslationsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'int',
                'constraint' => 12,
                'unsigned' => true,
                'auto_increment' => true,
                'null' => false,
            ],
            'table' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => false, 
            ],
            'column' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => false, 
            ],
            'translation' => [
                'type' => 'text',
                'null' => true, 
            ],
            'locale' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => false, 
            ],
            'table_id' => [
                'type' => 'int',
                'constraint' => 12,
                'unsigned' => true,
                'null' => false,
            ],
            'created_at' => [
                'type' => 'timestamp',
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'timestamp',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'timestamp',
                'null' => true,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('translations');
    }

    public function down()
    {
        $this->forge->dropTable('translations');
    }
}
