<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * One row per synchronization run (full / incremental / manual). Powers the
 * admin "Sinkronisasi Hotel" page (progress, history, last-sync time) and
 * links to the Bus batch so progress/failures are resumable and observable.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hotel_sync_run', function (Blueprint $table) {
            $table->id();
            $table->string('provider');                 // e.g. tbo
            $table->string('type');                     // full|incremental|manual
            $table->string('status')->default('queued')->index(); // queued|running|completed|failed|cancelled
            $table->string('batch_id')->nullable();     // job_batches.id
            $table->unsignedInteger('total_hotels')->default(0);
            $table->unsignedInteger('processed_hotels')->default(0);
            $table->unsignedInteger('failed_hotels')->default(0);
            $table->timestamp('started_at')->nullable();
            $table->timestamp('finished_at')->nullable();
            $table->text('error')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hotel_sync_run');
    }
};
