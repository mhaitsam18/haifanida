<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Management-set fixed FX costing rate, versioned by effective date.
 *
 * USD is the management input; SAR is stored explicitly but guarded against the
 * 3.75 SAR/USD peg by FxPolicyService (never below the peg-implied floor). A
 * costing pins the version it was built on, so an older sold package keeps its
 * rate forever. This is NOT a market rate — Bank Indonesia is market-watch only.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fx_policy_version', function (Blueprint $table) {
            $table->id();
            $table->string('base_currency', 3)->default('USD');
            $table->decimal('usd_idr', 12, 2);              // management input
            $table->decimal('sar_idr', 12, 2);              // explicit, peg-guarded
            $table->decimal('peg_sar_per_usd', 6, 4)->default(3.7500);
            $table->date('effective_from');
            $table->date('effective_to')->nullable();       // set when superseded
            $table->foreignId('created_by')->nullable()
                ->constrained('users')->nullOnDelete();
            $table->text('reason')->nullable();
            $table->timestamps();

            $table->index('effective_from');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fx_policy_version');
    }
};
