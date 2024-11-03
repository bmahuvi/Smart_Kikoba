<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class SavingMigration extends Migration
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
            'member_id' => [
                'type' => 'int',
                'constraint' => 11,
                'unsigned' => true
            ],
            'amount' => [
                'type' => 'int',
                'constraint' => 11
            ],
            'fine' => [
                'type' => 'int',
                'constraint' => 11,
                'default' => 0,
            ],
            'date_paid' => [
                'type' => 'DATETIME'
            ],
            'created_by' => [
                'type' => 'int',
                'constraint' => 11,
                'unsigned' => true
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'default' => new RawSql('current_timestamp')
            ],
            'updated_at DATETIME DEFAULT current_timestamp on update current_timestamp NULL',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('member_id', 'tbl_member', 'id');
        $this->forge->addForeignKey('created_by', 'tbl_user', 'id');
        $this->forge->createTable('tbl_saving', false);
    }

    public function down()
    {
        $this->forge->dropTable('tbl_saving', true);
    }
}
