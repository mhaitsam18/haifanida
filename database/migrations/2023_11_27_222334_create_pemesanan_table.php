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
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paket_id')->nullable()
                ->constrained('paket')
                ->onUpdate('cascade')
                ->nullOnDelete();
            $table->foreignId('user_id')->nullable()
                ->constrained('users')
                ->onUpdate('cascade')
                ->nullOnDelete();
            // Informasi pemesanan
            $table->string('status')->default('pending')->index(); // Status pemesanan (pending, confirmed, canceled, etc.)
            $table->date('tanggal_pesan')->nullable(); // Tanggal pemesanan
            $table->integer('jumlah_orang')->nullable(); // Jumlah orang yang memesan
            $table->float('total_harga', 16, 2)->nullable(); // Total harga pemesanan
            // Informasi pembayaran
            $table->string('metode_pembayaran')->nullable(); // Skema pembayaran yang dipilih saat booking (Cash, Tabungan, Cicilan, 'Umroh dulu, baru bayar') — beda konsep dari pembayaran.metode_pembayaran (kanal per transaksi)
            $table->boolean('is_pembayaran_lunas')->default(false); // Apakah pembayaran sudah lunas atau belum
            $table->date('tanggal_pelunasan')->nullable(); // Tanggal pelunasan (jika ada)
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan');
    }
};
