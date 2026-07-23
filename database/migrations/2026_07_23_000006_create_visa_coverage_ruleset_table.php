<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Effective-dated record of what the Saudi Umrah visa bundle covers. Saudi rules
 * have changed the cost structure twice recently (muassasah folded into the
 * visa, then Taif made free), so coverage is versioned data, not logic in code:
 * a costing resolves the ruleset as of its own DEPARTURE DATE, so reopening an
 * old costing sees the rules that applied then — not today's.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visa_coverage_ruleset', function (Blueprint $table) {
            $table->id();
            $table->json('provides_tags');                 // e.g. ["ground_transport_makkah_madinah","city_tour","taif_tour"]
            $table->date('effective_from');
            $table->text('note')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index('effective_from');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visa_coverage_ruleset');
    }
};
