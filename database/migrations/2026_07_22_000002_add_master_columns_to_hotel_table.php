<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Enriches the existing `hotel` table into Haifa's curated master record.
 *
 * STRICTLY ADDITIVE — every existing column (kode_hotel, nama_hotel, bintang,
 * bintang_setaraf, kota, negara, alamat, link_gmaps, gambar, deskripsi) is
 * left untouched so the production booking system (paket_hotel, admin CRUD,
 * API resources) keeps working exactly as before. All new columns are
 * nullable (or have safe defaults) so existing rows remain valid.
 *
 * Pricing / availability / room inventory are deliberately NOT added here —
 * those are rented data that will come from external inventory providers via
 * the hotel_external_id seam, never stored as hotel attributes.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hotel', function (Blueprint $table) {
            // Brand / chain
            $table->foreignId('hotel_chain_id')->nullable()->after('id')
                ->constrained('hotel_chain')->nullOnDelete();

            // Public identity / SEO
            $table->string('slug')->nullable()->unique()->after('nama_hotel');

            // Geo + proximity to the Haram / Nabawi (the decisive Umrah facts)
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->unsignedInteger('jarak_meter')->nullable();
            $table->unsignedSmallInteger('walking_distance_minutes')->nullable();
            $table->string('jarak_keterangan')->nullable();

            // Contact
            $table->string('website')->nullable();
            $table->string('telepon')->nullable();
            $table->string('email')->nullable();

            // Operational
            $table->time('checkin')->nullable();
            $table->time('checkout')->nullable();
            $table->unsignedInteger('jumlah_kamar')->nullable();

            // Guest review score (distinct from `bintang` star class)
            $table->decimal('review_score', 3, 1)->nullable();
            $table->string('review_sumber')->nullable();

            // Agency-side classification + operations
            $table->string('kategori')->nullable();
            $table->boolean('shuttle_tersedia')->nullable();

            // Stable external anchor (Google Maps place) — provider codes live
            // in the dedicated hotel_external_id table, not here.
            $table->string('google_place_id')->nullable();

            // Lifecycle
            $table->boolean('aktif')->default(true);

            // Indexes for the common filters (city, brand, active, star, slug)
            $table->index('kota');
            $table->index('aktif');
            $table->index(['kota', 'bintang']);
        });
    }

    public function down(): void
    {
        Schema::table('hotel', function (Blueprint $table) {
            $table->dropIndex(['kota', 'bintang']);
            $table->dropIndex(['aktif']);
            $table->dropIndex(['kota']);

            $table->dropConstrainedForeignId('hotel_chain_id');

            $table->dropColumn([
                'slug', 'latitude', 'longitude', 'jarak_meter', 'walking_distance_minutes',
                'jarak_keterangan', 'website', 'telepon', 'email', 'checkin', 'checkout',
                'jumlah_kamar', 'review_score', 'review_sumber', 'kategori',
                'shuttle_tersedia', 'google_place_id', 'aktif',
            ]);
        });
    }
};
