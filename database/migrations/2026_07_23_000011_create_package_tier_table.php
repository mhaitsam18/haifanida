<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Package tier / profile — a template ABOVE the departure (Addendum 3). A named
 * set of default component tier selections a new departure starts from; the
 * departure still owns its own rates. The workbook describes the STANDARD tier
 * only — its rates are seeded as standard, never as a global default.
 *
 * Margin-floor policy is per tier and can express an absolute floor, the greater
 * of an absolute and a percentage, or a per-quotation target (private). Actual
 * values are owner-set before Phase 6; the mechanism is built now.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('package_tier', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();               // budget | standard | premium | private
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->boolean('is_private')->default(false);
            $table->decimal('estimated_publish', 16, 2)->nullable();
            $table->string('margin_floor_type')->nullable(); // absolute | greater_of | per_quotation
            $table->decimal('margin_floor_amount', 16, 2)->nullable();
            $table->decimal('margin_floor_pct', 5, 2)->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('package_tier');
    }
};
