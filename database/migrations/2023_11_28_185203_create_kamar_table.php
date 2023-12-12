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
        Schema::create('kamar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paket_id')->nullable()
                ->constrained('paket')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('nomor_kamar')->nullable(); // Nomor identifikasi kamar
            $table->string('tipe_kamar')->nullable(); // Tipe kamar ('Single', 'Double', 'Quad', 'Suite', 'Lainnya')
            $table->integer('kapasitas')->nullable(); // Kapasitas maksimum penghuni
            $table->text('fasilitas')->nullable(); // Fasilitas yang disediakan di kamar
            $table->boolean('tersedia')->default(true); // Status kamar tersedia atau tidak
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamar');
    }
};
