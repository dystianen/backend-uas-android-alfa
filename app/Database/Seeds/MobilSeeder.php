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
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'merk'       => 'Honda',
                'model'      => 'Civic',
                'tahun'      => '2019',
                'warna'      => 'Putih',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'merk'       => 'Suzuki',
                'model'      => 'Ertiga',
                'tahun'      => '2021',
                'warna'      => 'Merah',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ];

        $this->db->table('mobil')->insertBatch($data);
    }
}
