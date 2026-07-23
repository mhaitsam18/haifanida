<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Departure (keberangkatan) — the costed, sold, settled unit. A Package template
 * (paket) may spawn many departures; the departure owns the costing inputs.
 *
 * procurement_mode drives the risk model: 'block' = seats bought in advance
 * (materialisation, deposit-at-risk, waiting list all apply); 'on_demand' =
 * FIT tickets bought against a confirmed order (private/open-trip — no block,
 * no threshold, TL opt-in). departure_date is nullable: private trips have no
 * fixed date until the customer agrees one.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('keberangkatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paket_id')->nullable()->constrained('paket')->nullOnDelete();
            $table->foreignId('package_tier_id')->nullable()->constrained('package_tier')->nullOnDelete();

            $table->string('procurement_mode')->default('block'); // block | on_demand
            $table->string('status')->default('draft');           // draft | open | closed | departed | cancelled
            $table->date('departure_date')->nullable();           // null until a private trip agrees one

            // Costing inputs.
            $table->unsignedInteger('planned_pax')->default(35);
            $table->unsignedInteger('seats_booked')->nullable();
            $table->unsignedInteger('free_seats')->default(0);
            $table->unsignedInteger('night_makkah')->default(4);
            $table->unsignedInteger('night_madinah')->default(4);
            $table->unsignedInteger('occupancy')->default(4);
            $table->unsignedInteger('saudi_ground_days')->nullable();
            $table->dateTime('arrival_at')->nullable();
            $table->dateTime('return_at')->nullable();
            $table->decimal('publish_price', 16, 2)->nullable();
            $table->decimal('channel_mix_agent_pct', 5, 4)->nullable();

            // Risk / rule switches.
            $table->decimal('materialisation_pct', 5, 4)->default(0.9000);
            $table->string('materialisation_basis')->default('booked'); // booked | paid | flown
            $table->string('forfeit_mode')->default('whole');           // whole | prorated
            $table->boolean('tl_opt_in')->default(false);
            $table->boolean('transit_villa')->default(false);
            $table->boolean('handling_bundled_la')->default(false);
            $table->boolean('mutawwif_free')->default(false);

            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['procurement_mode', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('keberangkatan');
    }
};
