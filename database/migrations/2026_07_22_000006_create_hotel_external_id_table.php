<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * The seam between Haifa's owned master data and future rented inventory.
 * Maps one curated hotel to its identifier in each external provider
 * (TBO, RateHawk, WebBeds, Hotelbeds, Google Places, ...). No provider is
 * integrated yet — this table simply makes future integration a data
 * concern, not a schema migration.
 *
 * `meta` (JSON) can hold provider-specific hints (e.g. a giata id, a
 * destination code) without new columns per provider.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hotel_external_id', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained('hotel')->cascadeOnDelete();
            $table->string('provider'); // e.g. tbo, ratehawk, webbeds, hotelbeds, google
            $table->string('external_id');
            $table->json('meta')->nullable();
            $table->timestamps();

            // One external code maps to at most one hotel per provider.
            $table->unique(['provider', 'external_id']);
            $table->index(['hotel_id', 'provider']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hotel_external_id');
    }
};
