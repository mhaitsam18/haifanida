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
        Schema::create('paket_hotel', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paket_id')->nullable()
                ->constrained('paket')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('hotel_id')->nullable()
                ->constrained('hotel')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('nomor_reservasi')->nullable();
            $table->date('tanggal_check_in')->nullable();
            $table->date('tanggal_check_out')->nullable();
            $table->integer('jumlah_kamar')->nullable();
            $table->float('total_harga', 16, 2)->nullable();
            $table->text('keterangan_hotel')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket_hotel');
    }
};
