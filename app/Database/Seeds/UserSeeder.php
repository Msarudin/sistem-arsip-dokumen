<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
         $data = [
            'nama'       => 'Admin Arsip',
            'email'      => 'efendimse@gmail.com',
            'password'   => password_hash('efendi123', PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $this->db->table('users')->insert($data);
    }
}
