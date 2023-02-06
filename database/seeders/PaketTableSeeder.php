<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Paket;

class PaketTableSeeder extends Seeder
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
                'jasa_id' => 1,
                'nama' => 'Paket Basic Banner Online',
                'deskripsi' => 'Paket murah banner online standart (1 konsep)
                - Revisi 3 kali
                - Hasil akhir JPG/PNG',
                'estimasi' => '2',
                'harga' => '120000',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'jasa_id' => 1,
                'nama' => 'Paket Master',
                'deskripsi' => '- File JPG/File PNG atau File lainnya sesuai kebutuhan
                - File Master AI / PSD',
                'estimasi' => '1',
                'harga' => '180000',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ];

        Paket::insert($data);
    }
}
