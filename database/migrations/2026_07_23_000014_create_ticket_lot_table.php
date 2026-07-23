<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * A ticket lot under a departure. A departure is NOT one ticket buy: when a
 * block fills and demand continues, further seats are bought at a different
 * price, so blended cost/seat follows from the lots (Q1 refinement).
 *
 * ticket_type (fit | group) drives both price and risk — FIT is why private
 * packages cost what they do. Deposit terms live here and feed deposit-at-risk:
 * layered deposits and contingent-liability-on-cancel mean walking away can cost
 * more than what has been paid (Addendum 1 §3).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ticket_lot', function (Blueprint $table) {
            $table->id();
            $table->foreignId('keberangkatan_id')->constrained('keberangkatan')->cascadeOnDelete();
            $table->foreignId('vendor_id')->nullable()->constrained('vendor')->nullOnDelete();

            $table->string('ticket_type')->default('group');   // fit | group
            $table->string('source')->nullable();              // airline_direct | broker
            $table->unsignedInteger('seats');
            $table->decimal('unit_price', 14, 2);
            $table->string('currency', 3)->default('IDR');

            // Deposit terms (enforcement of eligibility is on the ticket component).
            $table->string('deposit_type')->default('percentage'); // percentage | flat | none
            $table->decimal('deposit_pct', 5, 2)->nullable();
            $table->decimal('deposit_flat', 14, 2)->nullable();     // per seat when flat
            $table->boolean('deposit_is_layered')->default(false);
            $table->decimal('deposit_token', 14, 2)->nullable();    // low-entry token (per seat), balance owed behind it
            $table->boolean('contingent_liability_on_cancel')->default(false);
            $table->integer('settlement_deadline_offset_days')->nullable(); // H-x

            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ticket_lot');
    }
};
