<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Normalized, reusable facilities (WiFi, Prayer Room, Halal Restaurant,
 * Shuttle, ...) plus the hotel↔facility pivot. Normalized so facilities are
 * filterable ("hotels with prayer room + shuttle") and consistent across the
 * catalog. Meal/board options are modeled as facilities here rather than a
 * separate column; the board basis of a specific booking remains a
 * paket_hotel concern.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hotel_facility', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->string('icon')->nullable();
            $table->string('kategori')->nullable();
            $table->timestamps();
        });

        Schema::create('hotel_facility_pivot', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained('hotel')->cascadeOnDelete();
            $table->foreignId('facility_id')->constrained('hotel_facility')->cascadeOnDelete();

            $table->unique(['hotel_id', 'facility_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hotel_facility_pivot');
        Schema::dropIfExists('hotel_facility');
    }
};
