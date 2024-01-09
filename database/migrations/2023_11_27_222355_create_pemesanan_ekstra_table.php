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
        Schema::create('pemesanan_ekstra', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemesanan_id')->nullable()
                ->constrained('pemesanan')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('ekstra')->nullable();
            $table->string('jumlah')->nullable();
            $table->float('total_harga', 16, 2)->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan_ekstra');
    }
};
