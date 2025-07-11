<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MobilSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'merk'       => 'Toyota',
                'model'      => 'Avanza',
                'tahun'      => '2020',
                'warna'      => 'Hitam',
                'photo'      => '1752254075_5d46f3e4cad5ffabd10d.jpg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'merk'       => 'Honda',
                'model'      => 'Civic',
                'tahun'      => '2019',
                'warna'      => 'Putih',
                'photo'      => '1752254571_02bf4d6d7ac1c8953368.jpeg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'merk'       => 'Marcedes',
                'model'      => 'C200',
                'tahun'      => '2021',
                'warna'      => 'Black',
                'photo'      => '1752253892_2ad05a506bee95673bad.jpg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ];

        $this->db->table('mobil')->insertBatch($data);
    }
}
