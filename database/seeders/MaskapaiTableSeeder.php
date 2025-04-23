<?php

namespace Database\Seeders;

use App\Models\Maskapai;
use GuzzleHttp\Client;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Stichoza\GoogleTranslate\GoogleTranslate;

class MaskapaiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Hapus semua data maskapai
        DB::table('maskapai')->delete();

        // Panggil API AviationStack
        $client = new Client();
        $response = $client->get('http://api.aviationstack.com/v1/airlines', [
            'query' => [
                'access_key' => 'f7691ffaa95f0acb2614666df90cf4b8',
                'limit' => '300',
            ],
        ]);

        // Decode respons JSON
        $data = json_decode($response->getBody()->getContents(), true);

        // Proses dan masukkan data maskapai ke dalam database
        foreach ($data['data'] as $airline) {
            // Terjemahkan nama maskapai dari bahasa Inggris ke bahasa Indonesia
            $translatedCountry = $airline['country_name'] ? GoogleTranslate::trans($airline['country_name'], 'id') : null;
            $translatedType = $airline['type'] ? GoogleTranslate::trans($airline['type'], 'id') : null;

            // Cek apakah kode maskapai sudah ada di dalam tabel
            $existingCount = DB::table('maskapai')->where('kode_maskapai', $airline['iata_code'])->count();

            // Jika sudah ada, tambahkan angka pada akhir kode maskapai
            $newCode = $existingCount > 0 ? $airline['iata_code'] . ($existingCount + 1) : $airline['iata_code'];

            DB::table('maskapai')->insert([
                'kode_maskapai' => $newCode,
                'nama_maskapai' => $airline['airline_name'],
                'negara_asal' => $translatedCountry,
                'logo' => 'maskapai-logo/' . strtolower($newCode) . '.png',
                'deskripsi' => 'Maskapai penerbangan ' . $translatedType . ' dari ' . $translatedCountry,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
