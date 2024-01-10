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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemesanan_id')->nullable()
                ->constrained('pemesanan')
                ->onUpdate('cascade')
                ->nullOnDelete();
            $table->float('jumlah_pembayaran', 16, 2)->nullable();
            $table->string('metode_pembayaran')->nullable();
            $table->timestamp('tanggal_pembayaran')->nullable();
            $table->string('bukti_pembayaran')->nullable();
            $table->enum('status_pembayaran', ['tertunda', 'diterima', 'ditolak'])->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
