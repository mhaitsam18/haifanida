<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Ancillary product catalogue (Produk Tambahan). One product, two packaging
 * modes decided per package: all-in (folded into price, 100% take-up, certain
 * revenue) or optional (sold separately, partial take-up). vendor_choice_level
 * distinguishes insurance-like (per departure) from vaccination-like (per
 * pilgrim, often arranged elsewhere).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ancillary_product', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('nama');
            $table->string('family')->nullable();          // equipment_manasik | health | passport | merchandise | transport
            $table->string('vendor_choice_level')->default('per_pilgrim'); // per_departure | per_pilgrim
            $table->string('default_packaging')->default('optional');      // all_in | optional
            $table->decimal('default_cost', 14, 2)->nullable();
            $table->decimal('default_sell', 14, 2)->nullable();
            $table->decimal('default_takeup_pct', 5, 4)->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ancillary_product');
    }
};
