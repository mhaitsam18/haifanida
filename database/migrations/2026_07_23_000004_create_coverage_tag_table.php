<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Canonical vocabulary of coverage a purchasable service can PROVIDE or a cost
 * component can REQUIRE (e.g. city_tour, ground_transport_makkah_madinah).
 * The coverage resolver asserts each required tag is provided exactly once,
 * flagging overlap (double-count risk) and gaps.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('coverage_tag', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('label');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coverage_tag');
    }
};
