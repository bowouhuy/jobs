<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jasaimage;

class JasaimageTableSeeder extends Seeder
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
                'filename' => 'jasa1.jpg',
                'url' => 'jasa1.jpg',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'jasa_id' => 1,
                'filename' => 'jasa2.jpg',
                'url' => 'jasa2.jpg',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 3,
                'jasa_id' => 1,
                'filename' => 'jasa3.jpg',
                'url' => 'jasa3.jpg',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 4,
                'jasa_id' => 1,
                'filename' => 'jasa4.jpg',
                'url' => 'jasa4.jpg',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 5,
                'jasa_id' => 1,
                'filename' => 'jasa5.jpg',
                'url' => 'jasa5.jpg',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 6,
                'jasa_id' => 1,
                'filename' => 'jasa6.jpg',
                'url' => 'jasa6.jpg',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 7,
                'jasa_id' => 1,
                'filename' => 'jasa7.jpg',
                'url' => 'jasa7.jpg',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 8,
                'jasa_id' => 1,
                'filename' => 'jasa8.jpg',
                'url' => 'jasa8.jpg',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 9,
                'jasa_id' => 1,
                'filename' => 'jasa9.jpg',
                'url' => 'jasa9.jpg',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 10,
                'jasa_id' => 1,
                'filename' => 'jasa10.jpg',
                'url' => 'jasa10.jpg',
                'created_at' => date('Y-m-d H:i:s')
            ],
        ];

        Jasaimage::insert($data);
    }
}
