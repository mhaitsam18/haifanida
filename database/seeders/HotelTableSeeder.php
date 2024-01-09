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
            [
                'kode_hotel' => '',
                'nama_hotel' => 'Millennium Aqeeq',
                'bintang' => '5',
                'bintang_setaraf' => '5 Setaraf',
                'kota' => 'Madinah',
                'negara' => 'Arab Saudi',
                'alamat' => "Musab bin Omeir Street, Bada'ah, Madinah 42313, Arab Saudi",
                'link_gmaps' => 'https://maps.app.goo.gl/FqoSrTo7zdxXzStc8',
                'deskripsi' => "Hotel mewah yang terletak di jalan ramai berjarak 17 menit berjalan kaki dari Al-Masjid an-Nabawi dan 20 menit berjalan kaki dari Al-Baqi', sebuah pemakaman Islam kuno. Prince Mohammad Bin Abdulaziz International Airport berjarak 21 km.
Kamar dengan dekorasi bernuansa hangat dilengkapi Wi-Fi dan TV serta minibar dan ketel; beberapa memiliki area duduk. Suite dengan 1 dan 2 kamar tidur dilengkapi ruang keluarga, dan kamar level klub menawarkan akses ke lounge pribadi. Room service tersedia 24/7.
Fasilitas meliputi 2 restoran, kedai kopi, dan pasar, plus business center dan ruang pertemuan. Tersedia sarapan dan tempat parkir.",
                'gambar' => 'hotel-gambar/millennium-aqeeq.jpg',
            ],
        ];
        foreach ($hotels as $hotel) {
            Hotel::create($hotel);
        }
    }
}
