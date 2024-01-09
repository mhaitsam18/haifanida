<?php

namespace Database\Seeders;

use App\Models\BerkasJemaah;
use App\Models\BusJemaah;
use App\Models\Jemaah;
use App\Models\Kamar;
use App\Models\KamarJemaah;
use App\Models\SertifikatJemaah;
use App\Models\Testimoni;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JemaahTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jemaahs = [
            [
                'pemesanan_id' => 1,
                'grup_id' => 1,
                'nomor_ktp' => '3215151802990002',
                'nama_lengkap' => 'Haitsam',
                'nama_sesuai_paspor' => 'Haitsam Bin Fahruroji',
                'tempat_lahir' => 'Madinah',
                'tanggal_lahir' => '1999-02-18',
                'jenis_kelamin' => 'Laki-laki',
                'kewarganegaraan' => 'WNI',
                'alamat' => 'Jl. Raya Cilamaya, Dusun KedungAsem, Rt.08/Rw.04',
                'kelurahan' => 'Mekarmaya',
                'kecamatan' => 'Cilamaya Wetan',
                'kabupaten' => 'Karawang',
                'provinsi' => 'Jawa Barat',
                'kode_pos' => '41384',
                'nomor_telepon' => '+6282117503125',
                'email' => 'haitsam03@gmail.com',
                'tingkat_pendidikan' => 'D4/S1',
                'pekerjaan' => 'Wiraswasta',
                'nomor_paspor' => 'E5055707',
                'tempat_dikeluarkan' => 'KARAWANG',
                'tanggal_dikeluarkan' => '2023-09-06',
                'tanggal_kadaluarsa' => '2033-09-06',
                'pernah_umroh' => 1,
                'pernah_haji' => 1,
                'golongan_darah' => 'A',
                'foto' => 'jemaah-foto/haitsam.jpg',
                'nama_keluarga_terdekat' => 'Fahruroji',
                'kontak_keluarga_terdekat' => '081220747000',
            ],
            [
                'pemesanan_id' => 1,
                'grup_id' => 1,
                'mahram_id' => 1,
                'nomor_ktp' => '3215156503770006',
                'nama_lengkap' => 'Nenden Halimatu Saidah',
                'nama_sesuai_paspor' => 'Nenden Halimatu Saidah',
                'tempat_lahir' => 'Purwakarta',
                'tanggal_lahir' => '1977-03-25',
                'jenis_kelamin' => 'Perempuan',
                'kewarganegaraan' => 'WNI',
                'alamat' => 'Jl. Raya Sempur',
                'kelurahan' => 'Sempur',
                'kecamatan' => 'Plered',
                'kabupaten' => 'Purwakarta',
                'provinsi' => 'Jawa Barat',
                'kode_pos' => '41162',
                'nomor_telepon' => '+6281384129373',
                'email' => 'nhalimatu@gmail.com',
                'tingkat_pendidikan' => 'SLTA',
                'pekerjaan' => 'Ibu Rumah Tangga',
                // 'nomor_paspor' => 'E5055707',
                // 'tempat_dikeluarkan' => 'PURWAKARTA',
                // 'tanggal_dikeluarkan' => '2023-09-06',
                // 'tanggal_kadaluarsa' => '2033-09-06',
                'pernah_umroh' => 1,
                'pernah_haji' => 1,
                'golongan_darah' => 'B',
                'hubungan_mahram' => 'Anak',
                'foto' => 'jemaah-foto/nenden.jpg',
                'nama_keluarga_terdekat' => 'Haitsam',
                'kontak_keluarga_terdekat' => '082117503125',
            ],
        ];
        foreach ($jemaahs as $jemaah) {
            Jemaah::create($jemaah);
        }

        $testimonis = [
            [
                'jemaah_id' => 1,
                'isi_testimoni' => 'PT. Haifa Nida Wisata adalah biro perjalanan Umroh Terbaik',
                'rating' => '5',
            ],
            [
                'jemaah_id' => 2,
                'isi_testimoni' => 'PT. Haifa Nida Wisata adalah biro perjalanan Umroh Terbaik',
                'rating' => '5',
            ]
        ];

        foreach ($testimonis as $testimoni) {
            Testimoni::create($testimoni);
        }


        $sertifikats = [
            [
                'jemaah_id' => 1,
                'nomor_sertifikat' => '1',
                'tanggal_penerbitan' => '2024-03-05',
                'jenis_sertifikat' => 'Sertifikat Umroh',
                'sertifikat' => 'jemaah-sertifikat/sertifikat-1.jpg',
            ],
            [
                'jemaah_id' => 2,
                'nomor_sertifikat' => '2',
                'tanggal_penerbitan' => '2024-03-05',
                'jenis_sertifikat' => 'Sertifikat Umroh',
                'sertifikat' => 'jemaah-sertifikat/sertifikat-2.jpg',
            ]
        ];

        foreach ($sertifikats as $sertifikat) {
            SertifikatJemaah::create($sertifikat);
        }

        $berkass = [
            [
                'jemaah_id' => 1,
                'berkas_id' => 1,
                'file_path' => 'jemaah-berkas/berkas-1.jpg',
                'status' => 'tertunda',
            ],
            [
                'jemaah_id' => 2,
                'berkas_id' => 1,
                'file_path' => 'jemaah-berkas/berkas-2.pdf',
                'status' => 'tertunda',
            ],
        ];

        foreach ($berkass as $berkas) {
            BerkasJemaah::create($berkas);
        }


        $buses = [
            [
                'jemaah_id' => 1,
                'bus_id' => 1,
                'nomor_kursi' => '1',
            ],
            [
                'jemaah_id' => 2,
                'bus_id' => 1,
                'nomor_kursi' => '2',
            ],
        ];

        foreach ($buses as $bus) {
            BusJemaah::create($bus);
        }



        $kamars = [
            [
                'jemaah_id' => 1,
                'kamar_id' => Kamar::where('paket_hotel_id', 1)->where('nomor_kamar', 23)->first()->id,
            ],
            [
                'jemaah_id' => 1,
                'kamar_id' => Kamar::where('paket_hotel_id', 2)->where('nomor_kamar', 23)->first()->id,
            ],
            [
                'jemaah_id' => 2,
                'kamar_id' => Kamar::where('paket_hotel_id', 1)->where('nomor_kamar', 23)->first()->id,
            ],
            [
                'jemaah_id' => 2,
                'kamar_id' => Kamar::where('paket_hotel_id', 2)->where('nomor_kamar', 23)->first()->id,
            ],
        ];

        foreach ($kamars as $kamar) {
            KamarJemaah::create($kamar);
        }
    }
}
