<?php

namespace Database\Seeders;

use App\Models\Hotel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hotels = [
            [
                'kode_hotel' => '',
                'nama_hotel' => 'Hotel Anjum',
                'bintang' => '5',
                'bintang_setaraf' => '5 Setaraf',
                'kota' => 'Mekkah',
                'negara' => 'Arab Saudi',
                'alamat' => 'Umm Al Qura Street, Haratal Bab And Ash Shamiyyah, Makkah 21955, Arab Saudi',
                'link_gmaps' => 'https://maps.app.goo.gl/xku74pm4Vgocmdf57',
                'deskripsi' => '
Hotel mewah yang menghadap Masjidil Ḥaram atau Masjid Agung Mekkah ini berjarak 2 km dari Al Safa Royal Palace dan 11 km dari gunung Jabal An-Nur.
Kamar-kamar elegan memiliki Wi-Fi gratis, TV layar datar, dan kulkas mini, serta brankas, juga fasilitas untuk membuat kopi dan teh. Kamar di kelas yang lebih tinggi menawarkan pemandangan masjid. Suite mewah dilengkapi dengan ruang keluarga terpisah, sedangkan suite di kelas yang lebih tinggi memiliki tambahan kamar tidur. Kamar-kamar level klub menyertakan akses ke lounge pribadi. Room service ditawarkan.
Sarapan tersedia secara gratis. Ada 4 pilihan tempat makan, termasuk restoran prasmanan yang sejuk dan kafe 24 jam. Ada juga musala. Tersedia tempat parkir.',
                'gambar' => 'hotel-gambar/anjum.jpg',
            ],
        ];
        foreach ($hotels as $hotel) {
            Hotel::create($hotel);
        }
    }
}
