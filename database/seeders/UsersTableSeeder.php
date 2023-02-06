<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
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
                'username' => 'yonisaka',
                'first_name' => 'Yoni',
                'last_name' => 'Saka',
                'email' => 'yonisaka@gmail.com',
                'password' => bcrypt('admin'),
                'register_tanggal' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s')
            ]
        ];

        User::insert($data);
    }
}
