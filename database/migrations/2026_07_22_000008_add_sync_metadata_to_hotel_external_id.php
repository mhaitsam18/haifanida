<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Per-hotel-per-provider synchronization state. hotel_external_id is the
 * natural home: each row is one hotel as seen by one provider, so its sync
 * status lives with it. This is what makes "failed hotels" and incremental
 * ("only re-sync stale rows") queries trivial and provider-agnostic.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hotel_external_id', function (Blueprint $table) {
            $table->timestamp('last_synced_at')->nullable()->after('meta');
            $table->string('sync_status')->default('pending')->after('last_synced_at'); // pending|synced|failed
            $table->timestamp('provider_updated_at')->nullable()->after('sync_status');
            $table->text('sync_error')->nullable()->after('provider_updated_at');

            $table->index(['provider', 'sync_status']);
            $table->index('last_synced_at');
        });
    }

    public function down(): void
    {
        Schema::table('hotel_external_id', function (Blueprint $table) {
            $table->dropIndex(['provider', 'sync_status']);
            $table->dropIndex(['last_synced_at']);
            $table->dropColumn(['last_synced_at', 'sync_status', 'provider_updated_at', 'sync_error']);
        });
    }
};
