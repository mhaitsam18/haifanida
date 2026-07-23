<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Per-occupancy published prices for a costing. A departure sells quad / triple
 * / double / single (and up to 7-bed budget rooms) at different prices into the
 * same group, which a single paket.harga scalar cannot hold — paket.harga keeps
 * the quad headline for backward compatibility while the matrix lives here.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('costing_published_price', function (Blueprint $table) {
            $table->id();
            $table->foreignId('costing_id')->constrained('costing')->cascadeOnDelete();
            $table->unsignedInteger('occupancy');   // 4 = quad, 3 = triple, 2 = double, 1 = single, 7 = budget
            $table->string('label')->nullable();
            $table->decimal('price', 16, 2);
            $table->timestamps();

            $table->unique(['costing_id', 'occupancy']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('costing_published_price');
    }
};
