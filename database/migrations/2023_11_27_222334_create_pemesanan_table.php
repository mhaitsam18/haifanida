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
            // $table->foreignId('agen_id')->nullable()
            //     ->constrained('agen')
            //     ->onUpdate('cascade')
            //     ->nullOnDelete();
            // $table->foreignId('member_id')->nullable()
            //     ->constrained('member')
            //     ->onUpdate('cascade')
            //     ->nullOnDelete();
            // $table->foreignId('admin_id')->nullable()
            //     ->constrained('admin')
            //     ->onUpdate('cascade')
            //     ->nullOnDelete();
            // Kolom-kolom yang berkaitan dengan jenis pemesanan (Umroh, Haji, Wisata Halal)
            // $table->boolean('is_umroh')->default(false);
            // $table->boolean('is_haji')->default(false);
            // $table->boolean('is_wisata_halal')->default(false);
            // Informasi pemesanan
            $table->string('status')->default('pending'); // Status pemesanan (pending, confirmed, canceled, etc.)
            $table->date('tanggal_pesan')->nullable(); // Tanggal pemesanan
            // $table->date('tanggal_berangkat')->nullable(); // Tanggal keberangkatan
            $table->integer('jumlah_orang')->nullable(); // Jumlah orang yang memesan
            $table->float('total_harga', 16, 2)->nullable(); // Total harga pemesanan
            // Informasi pembayaran
            $table->string('metode_pembayaran')->nullable(); // Metode pembayaran yang digunakan
            $table->boolean('is_pembayaran_lunas')->default(false); // Apakah pembayaran sudah lunas atau belum
            $table->date('tanggal_pelunasan')->nullable(); // Tanggal pelunasan (jika ada)
            // Informasi penerbangan (jika diperlukan)
            // $table->foreignId('maskapai_id')->nullable()
            //     ->constrained('maskapai')
            //     ->onUpdate('cascade')
            //     ->nullOnDelete();
            // $table->string('nomor_penerbangan')->nullable();
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
