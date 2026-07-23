<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * The component taxonomy from the workbook's "Biaya Produksi" sheet. Each row
 * carries its COST BEHAVIOUR (the maths lives in a behaviour strategy, phase 3)
 * and, crucially, its VENDOR-ELIGIBILITY POLICY — scoped to the component, not
 * the vendor. Only the flight-ticket component rejects individuals / requires
 * an incorporated broker (the 2022 rule); hotels and everything else accept
 * individuals, so long-standing individual partners stay valid suppliers.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cost_component', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('nama');
            $table->string('kategori')->index();          // production | markup | ancillary
            $table->string('behavior');                    // PER_PILGRIM | PER_ROOM_NIGHT | PER_GROUP | PER_GROUP_PER_DAY | STEPPED | MIN_GUARANTEE | CONDITIONAL | CHANNEL_DEPENDENT | FOC_DILUTED | MARKUP
            $table->string('default_unit')->nullable();
            $table->string('default_currency', 3)->default('IDR');
            $table->json('provides_tags')->nullable();     // coverage this component includes (usually null; visa uses the effective-dated ruleset instead)
            $table->json('requires_tags')->nullable();     // coverage that must be met exactly once
            // Per-component vendor-eligibility policy (NOT a permanent stamp on a vendor).
            $table->boolean('requires_incorporated_vendor')->default(false);
            $table->boolean('rejects_individual_vendor')->default(false);
            $table->boolean('is_mandatory')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cost_component');
    }
};
