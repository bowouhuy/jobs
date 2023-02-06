<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'nama' => 'Desain Grafis',
                'icon' => 'fa fa-image fa-2x',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'nama' => 'Visual dan Audio',
                'icon' => 'fa fa-camera fa-2x',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 3,
                'nama' => 'Pemasaran dan Periklanan',
                'icon' => 'fa fa-paint-brush fa-2x',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 4,
                'nama' => 'Web dan Pemrograman',
                'icon' => 'fa fa-laptop fa-2x',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 5,
                'nama' => 'Penulisan dan Penerjemahan',
                'icon' => 'fa fa-pencil fa-2x',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ];

        Kategori::insert($data);
    }
}
