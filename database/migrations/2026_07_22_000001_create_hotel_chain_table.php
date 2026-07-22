<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Hotel chain / brand master (Hilton, Marriott, Accor, ...). Lets the app
 * group properties by brand ("show all Hilton hotels in Makkah & Madinah").
 * Singular table name to match this schema's convention (hotel, paket, ...).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hotel_chain', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->string('logo')->nullable();
            $table->string('negara_asal')->nullable();
            $table->string('website')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hotel_chain');
    }
};
