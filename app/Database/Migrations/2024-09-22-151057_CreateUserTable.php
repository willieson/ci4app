<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'fullname'    => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'email'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'password'    => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'oauth_id'    => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,  // Bisa diisi null jika tidak menggunakan OAuth
            ],
            'created_at'  => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'updated_at'  => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
        ]);

        $this->forge->addKey('id', true);  // Menjadikan 'id' sebagai primary key
        $this->forge->createTable('user');  // Membuat tabel 'user'
    }

    public function down()
    {
        $this->forge->dropTable('user');
    }
}
