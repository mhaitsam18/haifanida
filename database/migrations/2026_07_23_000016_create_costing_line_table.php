<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * One resolved component line inside a costing snapshot. Pins the rate_card
 * version used (rate_card_id) and records provenance (baseline vs contracted)
 * and why a line was zeroed (suppressed_reason), so a frozen costing is fully
 * self-explanatory years later.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('costing_line', function (Blueprint $table) {
            $table->id();
            $table->foreignId('costing_id')->constrained('costing')->cascadeOnDelete();
            $table->foreignId('cost_component_id')->nullable()->constrained('cost_component')->nullOnDelete();
            $table->foreignId('rate_card_id')->nullable()->constrained('rate_card')->nullOnDelete();

            $table->string('key');
            $table->string('nama');
            $table->string('kategori');
            $table->string('behavior');
            $table->decimal('group_total', 18, 2)->default(0);
            $table->decimal('per_pilgrim', 16, 2)->default(0);
            $table->boolean('active')->default(true);
            $table->boolean('is_baseline')->default(false);
            $table->string('rate_source')->nullable();
            $table->string('suppressed_reason')->nullable();
            $table->timestamps();

            $table->index(['costing_id', 'kategori']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('costing_line');
    }
};
