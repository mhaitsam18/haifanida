<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Immutable costing snapshot. On publish/freeze it PINS every rule that can
 * change over time — the FX version, each line's rate-card version (on
 * costing_line), the effective-dated visa coverage ruleset, and the overhead
 * rule + divisor — so reopening reproduces the original result instead of
 * silently recalculating under today's rules.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('costing', function (Blueprint $table) {
            $table->id();
            $table->foreignId('keberangkatan_id')->nullable()->constrained('keberangkatan')->nullOnDelete();
            $table->foreignId('paket_id')->nullable()->constrained('paket')->nullOnDelete();
            $table->string('status')->default('draft');        // draft | published | frozen

            // Inputs captured on the snapshot.
            $table->string('package_tier')->default('standard');
            $table->string('procurement_mode')->default('block');
            $table->unsignedInteger('paying_pax');
            $table->unsignedInteger('free_seats')->default(0);
            $table->unsignedInteger('seats_booked')->nullable();
            $table->decimal('publish_price', 16, 2)->nullable();
            $table->string('materialisation_basis')->default('booked');

            // Pinned versions / rules.
            $table->foreignId('fx_policy_version_id')->nullable()->constrained('fx_policy_version')->nullOnDelete();
            $table->foreignId('visa_coverage_ruleset_id')->nullable()->constrained('visa_coverage_ruleset')->nullOnDelete();
            $table->string('staff_salary_mode')->nullable();
            $table->text('staff_salary_rule')->nullable();
            $table->text('margin_floor_rule')->nullable();

            // Computed results.
            $table->decimal('production_group_total', 18, 2)->default(0);
            $table->decimal('production_per_pilgrim', 16, 2)->default(0);
            $table->decimal('burden_per_pilgrim', 16, 2)->default(0);
            $table->decimal('package_margin', 16, 2)->default(0);
            $table->decimal('expected_margin', 16, 2)->default(0);
            $table->decimal('margin_floor', 16, 2)->default(0);
            $table->decimal('distance_to_floor', 16, 2)->default(0);
            $table->string('margin_status')->nullable();
            $table->decimal('deposit_at_risk', 16, 2)->nullable();
            $table->boolean('materialisation_applicable')->default(true);

            $table->json('inputs_json')->nullable();           // full raw context for exact re-run
            $table->json('warnings_json')->nullable();

            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('published_at')->nullable();
            $table->timestamp('frozen_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('costing');
    }
};
