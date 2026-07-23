<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Rate card — layer 3. Priced rows, versioned by validity and never overwritten
 * (supersede via superseded_by).
 *
 * PROVENANCE (source) is first-class:
 *  - 'baseline'   → the workbook's currently-prevailing rates with NO named
 *                   counterparty (visa USD 140, tasreh SAR 30, ...). Linked to a
 *                   cost_component; a costing may fall back to it but the figure
 *                   is flagged as baseline, never presented as contracted.
 *  - 'contracted' → a real vendor rate under a vendor_service. Takes precedence
 *                   over baseline; baseline stays as a comparison reference and
 *                   is never silently shadowed.
 *  - others ('tbo','ratehawk','pusattiket',...) → API-sourced, written by adapters.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rate_card', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_service_id')->nullable()->constrained('vendor_service')->cascadeOnDelete();
            $table->foreignId('cost_component_id')->nullable()->constrained('cost_component')->nullOnDelete();
            $table->string('source')->default('manual');   // baseline | contracted | manual | tbo | ratehawk | pusattiket
            $table->string('currency', 3)->default('IDR');
            $table->decimal('amount', 14, 2);
            $table->string('unit')->nullable();
            $table->string('season')->nullable();          // low | normal | high | peak
            $table->integer('min_qty')->nullable();
            $table->unsignedBigInteger('tax_rule_id')->nullable(); // phase 7, no FK yet
            $table->date('valid_from');
            $table->date('valid_to')->nullable();
            $table->foreignId('superseded_by')->nullable()->constrained('rate_card')->nullOnDelete();
            $table->string('external_ref')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['cost_component_id', 'source']);
            $table->index(['vendor_service_id', 'valid_from']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rate_card');
    }
};
