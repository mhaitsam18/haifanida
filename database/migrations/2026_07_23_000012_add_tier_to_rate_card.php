<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Tags a rate card with the package tier it belongs to. Existing baseline rates
 * are the standard-tier prevailing figures, so they are set to 'standard' —
 * never left as a tier-less global default (Addendum 3).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rate_card', function (Blueprint $table) {
            $table->string('tier')->nullable()->after('source');
        });

        DB::table('rate_card')->where('source', 'baseline')->update(['tier' => 'standard']);
    }

    public function down(): void
    {
        Schema::table('rate_card', function (Blueprint $table) {
            $table->dropColumn('tier');
        });
    }
};
