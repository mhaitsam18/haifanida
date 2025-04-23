<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('permintaan_kamar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemesanan_kamar_id')->nullable()
                ->constrained('pemesanan_kamar')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('permintaan')->nullable();
            $table->float('harga', 16, 2)->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permintaan_kamar');
    }
};
