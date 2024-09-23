<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AdditionFieldUser extends Migration
{
    public function up()
    {
        // Gunakan query manual untuk menambahkan kolom baru dengan posisi tertentu
        $this->db->query('ALTER TABLE `user` ADD `phone` VARCHAR(20) DEFAULT NULL AFTER `password`;');
        $this->db->query('ALTER TABLE `user` ADD `address` VARCHAR(255) DEFAULT NULL AFTER `phone`;');
        $this->db->query('ALTER TABLE `user` ADD `profile_img` VARCHAR(255) DEFAULT NULL AFTER `address`;');
        $this->db->query('ALTER TABLE `user` ADD `role` VARCHAR(20) DEFAULT "user" NOT NULL AFTER `profile_img`;');
    }

    public function down()
    {
        // Hapus kolom yang ditambahkan jika rollback dilakukan
        $this->forge->dropColumn('user', 'phone');
        $this->forge->dropColumn('user', 'address');
        $this->forge->dropColumn('user', 'profile_img');
        $this->forge->dropColumn('user', 'role');
    }
}
