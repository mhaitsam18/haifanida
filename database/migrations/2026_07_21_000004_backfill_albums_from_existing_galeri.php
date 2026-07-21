<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Data migration: groups every existing galeri row into an album so the new
 * album-based public gallery starts fully populated. One album per paket
 * that has photos (titled with the paket name, dated with its departure),
 * plus a catch-all "Galeri Umum" album for photos with no paket.
 */
return new class extends Migration
{
    public function up(): void
    {
        $paketIds = DB::table('galeri')->whereNotNull('paket_id')->whereNull('album_id')
            ->distinct()->pluck('paket_id');

        foreach ($paketIds as $paketId) {
            $paket = DB::table('paket')->where('id', $paketId)->first();
            $cover = DB::table('galeri')->where('paket_id', $paketId)
                ->where('jenis', 'gambar')->orderBy('id')->value('file_path');

            $albumId = DB::table('album')->insertGetId([
                'judul' => $paket->nama_paket ?? ('Paket #' . $paketId),
                'deskripsi' => $paket ? ('Dokumentasi perjalanan ' . $paket->nama_paket) : null,
                'tanggal' => $paket->tanggal_mulai ?? null,
                'cover' => $cover,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('galeri')->where('paket_id', $paketId)->whereNull('album_id')
                ->update(['album_id' => $albumId]);
        }

        $orphanCount = DB::table('galeri')->whereNull('paket_id')->whereNull('album_id')->count();
        if ($orphanCount > 0) {
            $cover = DB::table('galeri')->whereNull('paket_id')->whereNull('album_id')
                ->where('jenis', 'gambar')->orderBy('id')->value('file_path');

            $albumId = DB::table('album')->insertGetId([
                'judul' => 'Galeri Umum',
                'deskripsi' => 'Dokumentasi kegiatan Haifa Nida Wisata',
                'tanggal' => null,
                'cover' => $cover,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('galeri')->whereNull('paket_id')->whereNull('album_id')
                ->update(['album_id' => $albumId]);
        }
    }

    public function down(): void
    {
        DB::table('galeri')->update(['album_id' => null]);
        DB::table('album')->delete();
    }
};
