<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Behaviour parameters as data, so the calculation stays generic: which nights
 * drive a room-night line (makkah/madinah), a quantity multiplier (CGK = 2
 * legs), which context switch activates/suppresses a line (transit villa on;
 * mutawwif / Makkah-Madinah handling off when an LA bundle covers them), and the
 * min-guarantee basis. No behaviour hard-codes a component.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cost_component', function (Blueprint $table) {
            $table->json('params')->nullable()->after('requires_tags');
        });
    }

    public function down(): void
    {
        Schema::table('cost_component', function (Blueprint $table) {
            $table->dropColumn('params');
        });
    }
};
