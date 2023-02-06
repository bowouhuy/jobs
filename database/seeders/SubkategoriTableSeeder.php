<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subkategori;

class SubkategoriTableSeeder extends Seeder
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
                'kategori_id' => 1,
                'nama' => 'Logo',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'kategori_id' => 1,
                'nama' => 'Pamflet',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 3,
                'kategori_id' => 1,
                'nama' => 'Poster',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 4,
                'kategori_id' => 1,
                'nama' => 'Brosur',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 5,
                'kategori_id' => 1,
                'nama' => 'Desain Baju',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 6,
                'kategori_id' => 1,
                'nama' => 'Desain Karakter',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 7,
                'kategori_id' => 1,
                'nama' => 'Template',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 8,
                'kategori_id' => 2,
                'nama' => 'Video Editing',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 9,
                'kategori_id' => 2,
                'nama' => 'Foto Editing',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 10,
                'kategori_id' => 2,
                'nama' => '3D dan Animasi',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 11,
                'kategori_id' => 3,
                'nama' => 'Pembuatan Blog',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 12,
                'kategori_id' => 4,
                'nama' => 'Pembuatan Website',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 13,
                'kategori_id' => 4,
                'nama' => 'Pembuatan Aplikasi',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 14,
                'kategori_id' => 5,
                'nama' => 'Pengetikan Umum',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 15,
                'kategori_id' => 5,
                'nama' => 'Microsoft Office',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 16,
                'kategori_id' => 5,
                'nama' => 'Penerjemah',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ];

        Subkategori::insert($data);
    }
}
