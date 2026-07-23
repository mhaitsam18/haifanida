<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * An ancillary line on a costing, with its packaging mode. counts_to_floor
 * encodes the critical rule: all-in ancillary margin is certain revenue and MAY
 * support the package margin floor; optional ancillary margin is uncertain and
 * must NOT — it can never make a Rp1.9jt package appear to clear the Rp2jt floor.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('costing_ancillary', function (Blueprint $table) {
            $table->id();
            $table->foreignId('costing_id')->constrained('costing')->cascadeOnDelete();
            $table->foreignId('ancillary_product_id')->nullable()->constrained('ancillary_product')->nullOnDelete();

            $table->string('key');
            $table->string('nama');
            $table->string('packaging')->default('optional'); // all_in | optional
            $table->decimal('cost', 14, 2)->default(0);
            $table->decimal('sell', 14, 2)->default(0);
            $table->decimal('takeup_pct', 5, 4)->nullable();  // optional mode only
            $table->decimal('participants', 8, 2)->default(0);
            $table->decimal('total_cost', 16, 2)->default(0);
            $table->decimal('total_revenue', 16, 2)->default(0);
            $table->decimal('margin', 16, 2)->default(0);
            $table->boolean('counts_to_floor')->default(false);
            $table->string('region_variant')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('costing_ancillary');
    }
};
