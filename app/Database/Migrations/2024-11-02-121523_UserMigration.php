<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class UserMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'int',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'first_name' => [
                'type' => 'VARCHAR',
                'constraint' => 32
            ],
            'last_name' => [
                'type' => 'VARCHAR',
                'constraint' => 32
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => 10
            ],
            'region' => [
                'type' => 'VARCHAR',
                'constraint' => 20
            ],
            'district' => [
                'type' => 'VARCHAR',
                'constraint' => 20
            ],
            'street' => [
                'type' => 'VARCHAR',
                'constraint' => 32,
                'null' => true
            ],
            'gender' => [
                'type' => 'ENUM',
                'constraint' => ['Male', 'Female']
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'role' => [
                'type' => 'ENUM',
                'constraint' => ['Admin', 'Member']
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['New', 'Active'],
                'default' => 'New'
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'default' => new RawSql('current_timestamp')
            ],
            'updated_at DATETIME DEFAULT current_timestamp on update current_timestamp NULL',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['phone', 'email']);
        $this->forge->createTable('tbl_user', false);
    }

    public function down()
    {
        $this->forge->dropTable('tbl_user', true);
    }
}
