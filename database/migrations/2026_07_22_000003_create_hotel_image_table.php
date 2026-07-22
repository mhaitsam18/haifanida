<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Hotel photo gallery. The existing hotel.gambar column stays as the single
 * "cover" image (backward compatible); this table holds the rest of the
 * gallery, ordered by `urutan`.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hotel_image', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained('hotel')->cascadeOnDelete();
            $table->string('path');
            $table->string('caption')->nullable();
            $table->unsignedInteger('urutan')->default(0);
            $table->timestamps();

            $table->index(['hotel_id', 'urutan']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hotel_image');
    }
};
