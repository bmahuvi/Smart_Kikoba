<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class GroupMigration extends Migration
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
            'group_name' => [
                'type' => 'VARCHAR',
                'constraint' => 60
            ],
            'region' => [
                'type' => 'VARCHAR',
                'constraint' => 20
            ],
            'district' => [
                'type' => 'VARCHAR',
                'constraint' => 20
            ],
            'is_active' => [
                'type' => 'int',
                'default' => 0
            ],
            'created_by' => [
                'type' => 'int',
                'constraint' => 11,
                'unsigned' => true
            ],
            'desc' => [
                'type' => 'TEXT'
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'default' => new RawSql('current_timestamp')
            ],
            'updated_at DATETIME DEFAULT current_timestamp on update current_timestamp NULL',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['group_name']);
        $this->forge->addForeignKey('created_by', 'tbl_user', 'id');
        $this->forge->createTable('tbl_group', false);
    }

    public function down()
    {
        $this->forge->dropTable('tbl_group', true);
    }
}
