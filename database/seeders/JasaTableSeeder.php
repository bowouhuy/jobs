<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jasa;

class JasaTableSeeder extends Seeder
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
                'subkategori_id' => 1,
                'mitra_id' => 1,
                'nama' => 'PROFESSIONAL DESAIN BANNER ONLINE/OFFLINE',
                'deskripsi' => 'Siap mengerjakan desain Brosur, Flyer, Banner, Web Banner dan Sosmed.. Desain yg di rancang untuk menunjang promosi produk atau event Anda baik untuk media online maupun media cetak..
                Dengan revisi unlimited selama masa kerja..
                content/tema/caption anda yang tentukan..',
                'rating' => 5,
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'subkategori_id' => 6,
                'mitra_id' => 1,
                'nama' => 'Desain Banner +Brosur+Flyer Untuk Promosikan Produk Anda',
                'deskripsi' => 'Hallo, Saya akan membuatkan Paket desain untuk keperluan promosi produk anda,

                Desain untuk pembuatan
                -Banner
                -Brosur
                -Flyer
                -DLL
                
                **Anda juga bisa melakukan custom order jika ingin di ganti dengan 
                INSTAGRAM BANNER
                INSTAGRAM FEED
                INSTAGRAM STORY
                FLYER/POSTER DESAIN
                FACEBOOK HEADER
                FACEBOOK ADS
                DLL
                
                Jika ingin custom order silahkan hubungi saya melalui pesan dan dapatkan penawaran dan harga menarik lainnya :)
                
                Langkah Pekerjaan
                Untuk Desain Banner +Brosur+Flyer Untuk Promosikan Produk Anda
                1. Berdiskusi dengan client
                2. Mulai Bekerja',
                'rating' => 5,
                'created_at' => date('Y-m-d H:i:s')
            ]
        ];

        Jasa::insert($data);
    }
}
