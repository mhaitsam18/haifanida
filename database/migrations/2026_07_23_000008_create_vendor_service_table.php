<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Vendor service — layer 2. What a vendor actually sells, at what tier (a CGK
 * handler sells nasi_box / lounge / buffet; an LA sells a bundle). When the
 * service IS a specific property, hotel_id maps it to the hotel master — so the
 * same property sold by several providers (Anjum via Diar / Maysan / Juhri) is
 * simply several vendor_service rows, each with its own rate card. Non-API
 * providers are first-class here, ranked alongside API-sourced inventory.
 *
 * coverage_tags declares what this service PROVIDES, which is what lets a bundle
 * suppress the individual components it already includes (via the resolver).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vendor_service', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained('vendor')->cascadeOnDelete();
            $table->foreignId('hotel_id')->nullable()->constrained('hotel')->nullOnDelete();
            $table->string('nama');
            $table->string('service_tier')->nullable();    // nasi_box | lounge | buffet | ...
            $table->json('coverage_tags')->nullable();     // what this service PROVIDES
            $table->string('behavior')->nullable();        // default cost behaviour for its rates
            $table->string('unit')->nullable();            // pax | group | room_night | group_day | leg | bus
            $table->boolean('aktif')->default(true);
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['vendor_id', 'hotel_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vendor_service');
    }
};
