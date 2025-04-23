<?php

namespace Database\Seeders;

use App\Models\Kabupaten;
use App\Models\Provinsi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KabupatenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinsiAceh = Provinsi::where('provinsi', 'Aceh')->first();
        $this->seedKabupaten($provinsiAceh, [
            'Kabupaten Aceh Barat',
            'Kabupaten Aceh Barat Daya',
            'Kabupaten Aceh Besar',
            'Kabupaten Aceh Jaya',
            'Kabupaten Aceh Selatan',
            'Kabupaten Aceh Singkil',
            'Kabupaten Aceh Tamiang',
            'Kabupaten Aceh Tengah',
            'Kabupaten Aceh Tenggara',
            'Kabupaten Aceh Timur',
            'Kabupaten Aceh Utara',
            'Kabupaten Bener Meriah',
            'Kabupaten Bireuer',
            'Kabupaten Gayo Lues',
            'Kabupaten Nagan Raya',
            'Kabupaten Pidie',
            'Kabupaten Pidie Jaya',
            'Kabupaten Simeulue',
            'Kota Banda Aceh',
            'Kota Langsa',
            'Kota Lhokseumawe',
            'Kota Sabang',
            'Kota Subulussalam',
        ]);

        $provinsiSumateraUtara = Provinsi::where('provinsi', 'Sumatera Utara')->first();
        $this->seedKabupaten($provinsiSumateraUtara, [
            'Kabupaten Asahan',
            'Kabupaten Batu Bara',
            'Kabupaten Dairi',
            'Kabupaten Deli Serdang',
            'Kabupaten Humbang Hasundutan',
            'Kabupaten Karo',
            'Kabupaten Labuhanbatu',
            'Kabupaten Labuhanbatu Selatan',
            'Kabupaten Labuhanbatu Utara',
            'Kabupaten Langkat',
            'Kabupaten Mandailing Natal',
            'Kabupaten Nias',
            'Kabupaten Nias Barat',
            'Kabupaten Nias Selatan',
            'Kabupaten Nias Utara',
            'Kabupaten Padang Lawas',
            'Kabupaten Padang Lawas Utara',
            'Kabupaten Pakpak Bharat',
            'Kabupaten Samosir',
            'Kabupaten Serdang Bedagai',
            'Kabupaten Simalungun',
            'Kabupaten Tapanuli Selatan',
            'Kabupaten Tapanuli Tengah',
            'Kabupaten Tapanuli Utara',
            'Kabupaten Toba',
            'Kota Binjai',
            'Kota Gunungsitoli',
            'Kota Medan',
            'Kota Padangsidimpuan',
            'Kota Pematangsiantar',
            'Kota Sibolga',
            'Kota Tanjungbalai',
            'Kota Tebing Tinggi',
        ]);

        $provinsiSumateraBarat = Provinsi::where('provinsi', 'Sumatera Barat')->first();
        $this->seedKabupaten($provinsiSumateraBarat, [
            'Kabupaten Agam',
            'Kabupaten Dharmasraya',
            'Kabupaten Kepulauan Mentawai',
            'Kabupaten Lima Puluh Kota',
            'Kabupaten Padang Pariaman',
            'Kabupaten Pasaman',
            'Kabupaten Pasaman Barat',
            'Kabupaten Pesisir Selatan',
            'Kabupaten Sijunjung',
            'Kabupaten Solok',
            'Kabupaten Solok Selatan',
            'Kabupaten Tanah Datar',
            'Kota Bukittinggi',
            'Kota Padang',
            'Kota Padang Panjang',
            'Kota Pariaman',
            'Kota Payakumbuh',
            'Kota Sawahlunto',
            'Kota Solok',
        ]);


        $provinsiRiau = Provinsi::where('provinsi', 'Riau')->first();
        $this->seedKabupaten($provinsiRiau, [
            'Kabupaten Bengkalis',
            'Kabupaten Indragiri Hilir',
            'Kabupaten Indragiri Hulu',
            'Kabupaten Kampar',
            'Kabupaten Kepulauan Meranti',
            'Kabupaten Kuantan Singingi',
            'Kabupaten Pelalawan',
            'Kabupaten Rokan Hilir',
            'Kabupaten Rokan Hulu',
            'Kabupaten Siak',
            'Kota Dumai',
            'Kota Pekanbaru',
        ]);

        $provinsiJambi = Provinsi::where('provinsi', 'Jambi')->first();
        $this->seedKabupaten($provinsiJambi, [
            'Kabupaten Batanghari',
            'Kabupaten Bungo',
            'Kabupaten Kerinci',
            'Kabupaten Merangin',
            'Kabupaten Muaro Jambi',
            'Kabupaten Sarolangun',
            'Kabupaten Tanjung Jabung Barat',
            'Kabupaten Tanjung Jabung Timur',
            'Kabupaten Tebo',
            'Kota Jambi',
            'Kota Sungai Penuh',
        ]);

        $provinsiSumateraSelatan = Provinsi::where('provinsi', 'Sumatera Selatan')->first();
        $this->seedKabupaten($provinsiSumateraSelatan, [
            'Kabupaten Banyuasin',
            'Kabupaten Empat Lawang',
            'Kabupaten Lahat',
            'Kabupaten Muara Enim',
            'Kabupaten Musi Banyuasin',
            'Kabupaten Musi Rawas',
            'Kabupaten Musi Rawas Utara',
            'Kabupaten Ogan Ilir',
            'Kabupaten Ogan Komering Ilir',
            'Kabupaten Ogan Komering Ulu',
            'Kabupaten Ogan Komering Ulu Selatan',
            'Kabupaten Ogan Komering Ulu Timur',
            'Kabupaten Penukal Abab Lematang Ilir',
            'Kota Lubuk Linggau',
            'Kota Pagaralam',
            'Kota Palembang',
            'Kota Prabumulih',
        ]);

        $provinsiBengkulu = Provinsi::where('provinsi', 'Bengkulu')->first();
        $this->seedKabupaten($provinsiBengkulu, [
            'Kabupaten Bengkulu Selatan',
            'Kabupaten Bengkulu Tengah',
            'Kabupaten Bengkulu Utara',
            'Kabupaten Kaur',
            'Kabupaten Kepahiang',
            'Kabupaten Lebong',
            'Kabupaten Mukomuko',
            'Kabupaten Rejang Lebong',
            'Kabupaten Seluma',
            'Kota Bengkulu',
        ]);

        $provinsiLampung = Provinsi::where('provinsi', 'Lampung')->first();
        $this->seedKabupaten($provinsiLampung, [
            'Kabupaten Lampung Barat',
            'Kabupaten Lampung Selatan',
            'Kabupaten Lampung Tengah',
            'Kabupaten Lampung Timur',
            'Kabupaten Lampung Utara',
            'Kabupaten Mesuji',
            'Kabupaten Pesawaran',
            'Kabupaten Pesisir Barat',
            'Kabupaten Pringsewu',
            'Kabupaten Tanggamus',
            'Kabupaten Tulang Bawang',
            'Kabupaten Tulang Bawang Barat',
            'Kabupaten Way Kanan',
            'Kota Bandar Lampung',
            'Kota Metro',
        ]);

        $provinsiKepulauanBangkaBelitung = Provinsi::where('provinsi', 'Kepulauan Bangka Belitung')->first();
        $this->seedKabupaten($provinsiKepulauanBangkaBelitung, [
            'Kabupaten Bangka',
            'Kabupaten Bangka Barat',
            'Kabupaten Bangka Selatan',
            'Kabupaten Bangka Tengah',
            'Kabupaten Belitung',
            'Kabupaten Belitung Timur',
            'Kota Pangkalpinang',
        ]);

        $provinsiKepulauanRiau = Provinsi::where('provinsi', 'Kepulauan Riau')->first();
        $this->seedKabupaten($provinsiKepulauanRiau, [
            'Kabupaten Bintan',
            'Kabupaten Karimun',
            'Kabupaten Kepulauan Anambas',
            'Kabupaten Lingga',
            'Kabupaten Natuna',
            'Kota Batam',
            'Kota Tanjungpinang',
        ]);

        $provinsiDKIJakarta = Provinsi::where('provinsi', 'DKI Jakarta')->first();
        $this->seedKabupaten($provinsiDKIJakarta, [
            'Kabupaten Administrasi Kepulauan Seribu',
            'Kota Administrasi Jakarta Barat',
            'Kota Administrasi Jakarta Pusat',
            'Kota Administrasi Jakarta Selatan',
            'Kota Administrasi Jakarta Timur',
            'Kota Administrasi Jakarta Utara',
        ]);

        $provinsiJawaBarat = Provinsi::where('provinsi', 'Jawa Barat')->first();
        $this->seedKabupaten($provinsiJawaBarat, [
            'Kabupaten Bandung',
            'Kabupaten Bandung Barat',
            'Kabupaten Bekasi',
            'Kabupaten Bogor',
            'Kabupaten Ciamis',
            'Kabupaten Cianjur',
            'Kabupaten Cirebon',
            'Kabupaten Garut',
            'Kabupaten Indramayu',
            'Kabupaten Karawang',
            'Kabupaten Kuningan',
            'Kabupaten Majalengka',
            'Kabupaten Pangandaran',
            'Kabupaten Purwakarta',
            'Kabupaten Subang',
            'Kabupaten Sukabumi',
            'Kabupaten Sumedang',
            'Kabupaten Tasikmalaya',
            'Kota Bandung',
            'Kota Banjar',
            'Kota Bekasi',
            'Kota Bogor',
            'Kota Cimahi',
            'Kota Cirebon',
            'Kota Depok',
            'Kota Sukabumi',
            'Kota Tasikmalaya',
        ]);

        $provinsiJawaTengah = Provinsi::where('provinsi', 'Jawa Tengah')->first();
        $this->seedKabupaten($provinsiJawaTengah, [
            'Kabupaten Banjamegara',
            'Kabupaten Banyumas',
            'Kabupaten Batang',
            'Kabupaten Blora',
            'Kabupaten Boyolali',
            'Kabupaten Brebes',
            'Kabupaten Cilacap',
            'Kabupaten Demak',
            'Kabupaten Grobogan',
            'Kabupaten Jepara',
            'Kabupaten Karanganyar',
            'Kabupaten Kebumen',
            'Kabupaten Kendal',
            'Kabupaten Klaten',
            'Kabupaten Kudus',
            'Kabupaten Magelang',
            'Kabupaten Pati',
            'Kabupaten Pekalongan',
            'Kabupaten Pemalang',
            'Kabupaten Purbalingga',
            'Kabupaten Purworejo',
            'Kabupaten Rembang',
            'Kabupaten Semarang',
            'Kabupaten Sragen',
            'Kabupaten Sukoharjo',
            'Kabupaten Tegal',
            'Kabupaten Temanggung',
            'Kabupaten Wonogiri',
            'Kabupaten Wonosobo',
            'Kota Magelang',
            'Kota Pekalongan',
            'Kota Salatiga',
            'Kota Semarang',
            'Kota Surakarta',
            'Kota Tegal',
        ]);

        $provinsiDIYogyakarta = Provinsi::where('provinsi', 'DI Yogyakarta')->first();
        $this->seedKabupaten($provinsiDIYogyakarta, [
            'Kabupaten Bantul',
            'Kabupaten Gunungkidul',
            'Kabupaten Kulon Progo',
            'Kabupaten Sleman',
            'Kota Yogyakarta',
        ]);

        $provinsiJawaTimur = Provinsi::where('provinsi', 'Jawa Timur')->first();
        $this->seedKabupaten($provinsiJawaTimur, [
            'Kabupaten Bangkalan',
            'Kabupaten Banyuwangi',
            'Kabupaten Blitar',
            'Kabupaten Bojonegoro',
            'Kabupaten Bondowoso',
            'Kabupaten Gresik',
            'Kabupaten Jember',
            'Kabupaten Jombang',
            'Kabupaten Kediri',
            'Kabupaten Lamongan',
            'Kabupaten Lumajang',
            'Kabupaten Madiun',
            'Kabupaten Magetan',
            'Kabupaten Malang',
            'Kabupaten Mojokerto',
            'Kabupaten Nganjuk',
            'Kabupaten Ngawi',
            'Kabupaten Pacitan',
            'Kabupaten Pamekasan',
            'Kabupaten Pasuruan',
            'Kabupaten Ponorogo',
            'Kabupaten Probolinggo',
            'Kabupaten Sampang',
            'Kabupaten Sidoarjo',
            'Kabupaten Situbondo',
            'Kabupaten Sumenep',
            'Kabupaten Trenggalek',
            'Kabupaten Tuban',
            'Kabupaten Tulungagung',
            'Kota Batu',
            'Kota Blitar',
            'Kota Kediri',
            'Kota Madiun',
            'Kota Malang',
            'Kota Mojokerto',
            'Kota Pasuruan',
            'Kota Probolinggo',
            'Kota Surabaya',
        ]);

        $provinsiBanten = Provinsi::where('provinsi', 'Banten')->first();
        $this->seedKabupaten($provinsiBanten, [
            'Kabupaten Lebak',
            'Kabupaten Pandeglang',
            'Kabupaten Serang',
            'Kabupaten Tangerang',
            'Kota Cilegon',
            'Kota Serang',
            'Kota Tangerang',
            'Kota Tangerang Selatan',
        ]);

        $provinsiBali = Provinsi::where('provinsi', 'Bali')->first();
        $this->seedKabupaten($provinsiBali, [
            'Kabupaten Badung',
            'Kabupaten Bangli',
            'Kabupaten Buleleng',
            'Kabupaten Gianyar',
            'Kabupaten Jembrana',
            'Kabupaten Karangasem',
            'Kabupaten Klungkung',
            'Kabupaten Tabanan',
            'Kota Denpasar',
        ]);

        $provinsiNTB = Provinsi::where('provinsi', 'Nusa Tenggara Barat')->first();
        $this->seedKabupaten($provinsiNTB, [
            'Kabupaten Bima',
            'Kabupaten Dompu',
            'Kabupaten Lombok Barat',
            'Kabupaten Lombok Tengah',
            'Kabupaten Lombok Timur',
            'Kabupaten Lombok Utara',
            'Kabupaten Sumbawa',
            'Kabupaten Sumbawa Barat',
            'Kota Bima',
            'Kota Mataram',
        ]);

        $provinsiNTT = Provinsi::where('provinsi', 'Nusa Tenggara Timur')->first();
        $this->seedKabupaten($provinsiNTT, [
            'Kabupaten Alor',
            'Kabupaten Belu',
            'Kabupaten Ende',
            'Kabupaten Flores Timur',
            'Kabupaten Kupang',
            'Kabupaten Lembata',
            'Kabupaten Malaka',
            'Kabupaten Manggarai',
            'Kabupaten Manggarai Barat',
            'Kabupaten Manggarai Timur',
            'Kabupaten Nagekeo',
            'Kabupaten Ngada',
            'Kabupaten Rote Ndao',
            'Kabupaten Sabu Raijua',
            'Kabupaten Sikka',
            'Kabupaten Sumba Barat',
            'Kabupaten Sumba Barat Daya',
            'Kabupaten Sumba Tengah',
            'Kabupaten Sumba Timur',
            'Kabupaten Timor Tengah Selatan',
            'Kabupaten Timor Tengah Utara',
            'Kota Kupang',
        ]);

        $provinsiKalBar = Provinsi::where('provinsi', 'Kalimantan Barat')->first();
        $this->seedKabupaten($provinsiKalBar, [
            'Kabupaten Bengkayang',
            'Kabupaten Kapuas Hulu',
            'Kabupaten Kayong Utara',
            'Kabupaten Ketapang',
            'Kabupaten Kubu Raya',
            'Kabupaten Landak',
            'Kabupaten Melawi',
            'Kabupaten Mempawah',
            'Kabupaten Sambas',
            'Kabupaten Sanggau',
            'Kabupaten Sekadau',
            'Kabupaten Sintang',
            'Kota Pontianak',
            'Kota Singkawang',
        ]);

        $provinsiKalTengah = Provinsi::where('provinsi', 'Kalimantan Tengah')->first();
        $this->seedKabupaten($provinsiKalTengah, [
            'Kabupaten Barito Selatan',
            'Kabupaten Barito Timur',
            'Kabupaten Barito Utara',
            'Kabupaten Gunung Mas',
            'Kabupaten Kapuas',
            'Kabupaten Katingan',
            'Kabupaten Kotawaringin Barat',
            'Kabupaten Kotawaringin Timur',
            'Kabupaten Lamandau',
            'Kabupaten Murung Raya',
            'Kabupaten Pulang Pisau',
            'Kabupaten Seruyan',
            'Kabupaten Sukamara',
            'Kota Palangka Raya',
        ]);

        $provinsiKalSel = Provinsi::where('provinsi', 'Kalimantan Selatan')->first();
        $this->seedKabupaten($provinsiKalSel, [
            'Kabupaten Balangan',
            'Kabupaten Banjar',
            'Kabupaten Barito Kuala',
            'Kabupaten Hulu Sungai Selatan',
            'Kabupaten Hulu Sungai Tengah',
            'Kabupaten Hulu Sungai Utara',
            'Kabupaten Kotabaru',
            'Kabupaten Tabalong',
            'Kabupaten Tanah Bumbu',
            'Kabupaten Tanah Laut',
            'Kabupaten Tapin',
            'Kota Banjarbaru',
            'Kota Banjarmasin',
        ]);

        $provinsiKalTim = Provinsi::where('provinsi', 'Kalimantan Timur')->first();
        $this->seedKabupaten($provinsiKalTim, [
            'Kabupaten Berau',
            'Kabupaten Kutai Barat',
            'Kabupaten Kutai Kartanegara',
            'Kabupaten Kutai Timur',
            'Kabupaten Mahakam Ulu',
            'Kabupaten Paser',
            'Kabupaten Penajam Paser Utara',
            'Kota Balikpapan',
            'Kota Bontang',
            'Kota Samarinda',
        ]);

        $provinsiKalUtara = Provinsi::where('provinsi', 'Kalimantan Utara')->first();
        $this->seedKabupaten($provinsiKalUtara, [
            'Kabupaten Bulungan',
            'Kabupaten Malinau',
            'Kabupaten Nunukan',
            'Kabupaten Tana Tidung',
            'Kota Tarakan',
        ]);

        $provinsiSulUt = Provinsi::where('provinsi', 'Sulawesi Utara')->first();
        $this->seedKabupaten($provinsiSulUt, [
            'Kabupaten Bolaang Mongondow',
            'Kabupaten Bolaang Mongondow Selatan',
            'Kabupaten Bolaang Mongondow Timur',
            'Kabupaten Bolaang Mongondow Utara',
            'Kabupaten Kepulauan Sangihe',
            'Kabupaten Kepulauan Siau Tagulandang Biaro',
            'Kabupaten Kepulauan Talaud',
            'Kabupaten Minahasa',
            'Kabupaten Minahasa Selatan',
            'Kabupaten Minahasa Tenggara',
            'Kabupaten Minahasa Utara',
            'Kota Bitung',
            'Kota Kotamobagu',
            'Kota Manado',
            'Kota Tomohon',
        ]);

        $provinsiSulTengah = Provinsi::where('provinsi', 'Sulawesi Tengah')->first();
        $this->seedKabupaten($provinsiSulTengah, [
            'Kabupaten Banggai',
            'Kabupaten Banggai Kepulauan',
            'Kabupaten Banggai Laut',
            'Kabupaten Buol',
            'Kabupaten Donggala',
            'Kabupaten Morowali',
            'Kabupaten Morowali Utara',
            'Kabupaten Parigi Moutong',
            'Kabupaten Poso',
            'Kabupaten Sigi',
            'Kabupaten Tojo Una-Una',
            'Kabupaten Tolitoli',
            'Kota Palu',
        ]);

        $provinsiSulSel = Provinsi::where('provinsi', 'Sulawesi Selatan')->first();
        $this->seedKabupaten($provinsiSulSel, [
            'Kabupaten Bantaeng',
            'Kabupaten Barru',
            'Kabupaten Bone',
            'Kabupaten Bulukumba',
            'Kabupaten Enrekang',
            'Kabupaten Gowa',
            'Kabupaten Jeneponto',
            'Kabupaten Kepulauan Selayar',
            'Kabupaten Luwu',
            'Kabupaten Luwu Timur',
            'Kabupaten Luwu Utara',
            'Kabupaten Maros',
            'Kabupaten Pangkajene dan Kepulauan',
            'Kabupaten Pinrang',
            'Kabupaten Sidenreng Rappang',
            'Kabupaten Sinjai',
            'Kabupaten Soppeng',
            'Kabupaten Takalar',
            'Kabupaten Tana Toraja',
            'Kabupaten Toraja Utara',
            'Kabupaten Wajo',
            'Kota Makassar',
            'Kota Palopo',
            'Kota Parepare',
        ]);

        $provinsiSulTenggara = Provinsi::where('provinsi', 'Sulawesi Tenggara')->first();
        $this->seedKabupaten($provinsiSulTenggara, [
            'Kabupaten Bombana',
            'Kabupaten Buton',
            'Kabupaten Buton Selatan',
            'Kabupaten Buton Tengah',
            'Kabupaten Buton Utara',
            'Kabupaten Kolaka',
            'Kabupaten Kolaka Timur',
            'Kabupaten Kolaka Utara',
            'Kabupaten Konawe',
            'Kabupaten Konawe Kepulauan',
            'Kabupaten Konawe Selatan',
            'Kabupaten Konawe Utara',
            'Kabupaten Muna',
            'Kabupaten Muna Barat',
            'Kabupaten Wakatobi',
            'Kota Baubau',
            'Kota Kendari',
        ]);

        $provinsiGorontalo = Provinsi::where('provinsi', 'Gorontalo')->first();
        $this->seedKabupaten($provinsiGorontalo, [
            'Kabupaten Boalemo',
            'Kabupaten Bone Bolango',
            'Kabupaten Gorontalo',
            'Kabupaten Gorontalo Utara',
            'Kabupaten Pohuwato',
            'Kota Gorontalo',
        ]);

        $provinsiSulBar = Provinsi::where('provinsi', 'Sulawesi Barat')->first();
        $this->seedKabupaten($provinsiSulBar, [
            'Kabupaten Majene',
            'Kabupaten Mamasa',
            'Kabupaten Mamuju',
            'Kabupaten Mamuju Tengah',
            'Kabupaten Pasangkayu',
            'Kabupaten Polewali Mandar',
        ]);

        $provinsiMaluku = Provinsi::where('provinsi', 'Maluku')->first();
        $this->seedKabupaten($provinsiMaluku, [
            'Kabupaten Buru',
            'Kabupaten Buru Selatan',
            'Kabupaten Kepulauan Aru',
            'Kabupaten Kepulauan Tanimbar',
            'Kabupaten Maluku Barat Daya',
            'Kabupaten Maluku Tengah',
            'Kabupaten Maluku Tenggara',
            'Kabupaten Seram Bagian Barat',
            'Kabupaten Seram Bagian Timur',
            'Kota Ambon',
            'Kota Tual',
        ]);

        $provinsiMalut = Provinsi::where('provinsi', 'Maluku Utara')->first();
        $this->seedKabupaten($provinsiMalut, [
            'Kabupaten Halmahera Barat',
            'Kabupaten Halmahera Selatan',
            'Kabupaten Halmahera Tengah',
            'Kabupaten Halmahera Timur',
            'Kabupaten Halmahera Utara',
            'Kabupaten Kepulauan Sula',
            'Kabupaten Pulau Morotai',
            'Kabupaten Pulau Taliabu',
            'Kota Ternate',
            'Kota Tidore Kepulauan',
        ]);

        $provinsiPapua = Provinsi::where('provinsi', 'Papua')->first();
        $this->seedKabupaten($provinsiPapua, [
            'Kabupaten Biak Numfor',
            'Kabupaten Jayapura',
            'Kabupaten Keerom',
            'Kabupaten Kepulauan Yapen',
            'Kabupaten Mamberamo Raya',
            'Kabupaten Sarmi',
            'Kabupaten Supiori',
            'Kabupaten Waropen',
            'Kota Jayapura',
        ]);

        $provinsiPapuaBarat = Provinsi::where('provinsi', 'Papua Barat')->first();
        $this->seedKabupaten($provinsiPapuaBarat, [
            'Kabupaten Fakfak',
            'Kabupaten Kaimana',
            'Kabupaten Manokwari',
            'Kabupaten Manokwari Selatan',
            'Kabupaten Pegunungan Arfak',
            'Kabupaten Teluk Bintuni',
            'Kabupaten Teluk Wondama',
        ]);

        $provinsiPapuaSelatan = Provinsi::where('provinsi', 'Papua Selatan')->first();
        $this->seedKabupaten($provinsiPapuaSelatan, [
            'Kabupaten Asmat',
            'Kabupaten Boven Digoel',
            'Kabupaten Mappi',
            'Kabupaten Merauke',
        ]);

        $provinsiPapuaTengah = Provinsi::where('provinsi', 'Papua Tengah')->first();
        $this->seedKabupaten($provinsiPapuaTengah, [
            'Kabupaten Deiyai',
            'Kabupaten Dogiyai',
            'Kabupaten Intan Jaya',
            'Kabupaten Mimika',
            'Kabupaten Nabire',
            'Kabupaten Paniai',
            'Kabupaten Puncak',
            'Kabupaten Puncak Jaya',
        ]);

        $provinsiPapuaPegunungan = Provinsi::where('provinsi', 'Papua Pegunungan')->first();
        $this->seedKabupaten($provinsiPapuaPegunungan, [
            'Kabupaten Jayawijaya',
            'Kabupaten Lanny Jaya',
            'Kabupaten Mamberamo Tengah',
            'Kabupaten Nduga',
            'Kabupaten Pegunungan Bintang',
            'Kabupaten Tolikara',
            'Kabupaten Yalimo',
            'Kabupaten Yahukimo',
        ]);

        $provinsiPapuaBaratDaya = Provinsi::where('provinsi', 'Papua Barat Daya')->first();
        $this->seedKabupaten($provinsiPapuaBaratDaya, [
            'Kabupaten Maybrat',
            'Kabupaten Raja Ampat',
            'Kabupaten Sorong',
            'Kabupaten Sorong Selatan',
            'Kabupaten Tambrauw',
            'Kota Sorong',
        ]);

        // Tambahkan provinsi dan kabupaten lainnya sesuai kebutuhan

        // Contoh untuk provinsi dan kabupaten lainnya
        /*
        $provinsiJawaBarat = Provinsi::where('provinsi', 'Jawa Barat')->first();
        $this->seedKabupaten($provinsiJawaBarat, [
            'Kabupaten Bandung',
            'Kabupaten Bekasi',
            // ... tambahkan kabupaten/kota lainnya ...
        ]);
        */
    }

    /**
     * Seed kabupaten based on provinsi.
     *
     * @param \App\Models\Provinsi $provinsi
     * @param array $kabupatenList
     */
    private function seedKabupaten(Provinsi $provinsi, array $kabupatenList): void
    {
        foreach ($kabupatenList as $kabupaten) {
            Kabupaten::create([
                'kabupaten' => $kabupaten,
                'provinsi_id' => $provinsi->id,
            ]);
        }
    }
}
