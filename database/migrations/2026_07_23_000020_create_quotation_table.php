<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * A private/quotation record. Private trips are quoted after consultation and go
 * through several rounds of customisation, and input costs move faster than
 * customers decide — so each quote is persisted with a reference, a version, the
 * configuration it was built from, the costing snapshot it pins, and an expiry.
 * Reopening after expiry warns rather than silently recosting (Addendum 4).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quotation', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->index();          // e.g. Q-2026-0001 (shared across versions)
            $table->unsignedInteger('version')->default(1);
            $table->foreignId('keberangkatan_id')->nullable()->constrained('keberangkatan')->nullOnDelete();
            $table->foreignId('costing_id')->nullable()->constrained('costing')->nullOnDelete(); // pinned snapshot
            $table->foreignId('paket_id')->nullable()->constrained('paket')->nullOnDelete();

            $table->string('customer_name')->nullable();
            $table->json('config_json')->nullable();        // the configuration this version was built from
            $table->decimal('quoted_price', 16, 2)->nullable();
            $table->decimal('quoted_margin', 16, 2)->nullable();
            $table->date('valid_until')->nullable();
            $table->string('status')->default('draft');     // draft | sent | accepted | expired | superseded

            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->unique(['reference', 'version']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quotation');
    }
};
