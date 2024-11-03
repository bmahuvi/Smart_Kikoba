<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class MemberMigration extends Migration
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
            'gender' => [
                'type' => 'ENUM',
                'constraint' => ['Male', 'Female']
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => 10
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true
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
            'is_active' => [
                'type' => 'int',
                'default' => 1
            ],
            'created_by' => [
                'type' => 'int',
                'constraint' => 11,
                'unsigned' => true
            ],
            'group_id' => [
                'type' => 'int',
                'constraint' => 11,
                'unsigned' => true
            ],
            'status' => [
                'type' => 'enum',
                'constraint' => ['Active', 'Dormant', 'Blocked'],
                'default' => 'Active'
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'default' => new RawSql('current_timestamp')
            ],
            'updated_at DATETIME DEFAULT current_timestamp on update current_timestamp NULL',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['email', 'phone']);
        $this->forge->addForeignKey('created_by', 'tbl_user', 'id');
        $this->forge->addForeignKey('group_id', 'tbl_group', 'id');
        $this->forge->createTable('tbl_member', false);
    }

    public function down()
    {
        $this->forge->dropTable('tbl_member', true);
    }
}
