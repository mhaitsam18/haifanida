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
        Schema::create('pesanan_pelanggan', function (Blueprint $table) {
            $table->foreignId('pelanggan_id')->constrained('pelanggan');
            $table->foreignId('pesanan_id')->constrained('pesanan');
            $table->boolean('pemesan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan_pelanggan');
    }
};
