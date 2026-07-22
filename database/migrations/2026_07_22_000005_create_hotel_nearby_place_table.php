<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Nearby landmarks per hotel (gates of the Haram, ZamZam, malls, airport, ...)
 * with distance and walking time — the wayfinding context Umrah pilgrims care
 * about most.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hotel_nearby_place', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained('hotel')->cascadeOnDelete();
            $table->string('nama');
            $table->unsignedInteger('jarak_meter')->nullable();
            $table->unsignedSmallInteger('walking_distance_minutes')->nullable();
            $table->string('jenis')->nullable(); // e.g. gerbang, masjid, mall, bandara, landmark
            $table->timestamps();

            $table->index('hotel_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hotel_nearby_place');
    }
};
