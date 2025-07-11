<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMobilTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'merk'       => ['type' => 'VARCHAR', 'constraint' => 100],
            'model'      => ['type' => 'VARCHAR', 'constraint' => 100],
            'tahun'      => ['type' => 'VARCHAR', 'constraint' => 10],
            'warna'      => ['type' => 'VARCHAR', 'constraint' => 50],
            'photo'      => ['type' => 'VARCHAR', 'constraint' => 50],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
            'deleted_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);

        $this->forge->createTable('mobil');
    }

    public function down()
    {
        $this->forge->dropTable('mobil');
    }
}
