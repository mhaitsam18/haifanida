<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Manually-entered market USD/IDR observations, so the FX screen can show the
 * policy-versus-market buffer. The peg guard compares SAR against USD but
 * nothing compared our policy rate against the actual market — which touched
 * Rp18,209 in June, above our Rp18,000 policy (Addendum 4). A policy rate below
 * market silently understates cost. The Bank Indonesia adapter is Phase 10; this
 * is the cheap interim.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fx_market_rate', function (Blueprint $table) {
            $table->id();
            $table->decimal('usd_idr', 12, 2);
            $table->date('observed_on');
            $table->string('source')->nullable();          // e.g. BI Jisdor, bank quote
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->text('note')->nullable();
            $table->timestamps();

            $table->index('observed_on');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fx_market_rate');
    }
};
