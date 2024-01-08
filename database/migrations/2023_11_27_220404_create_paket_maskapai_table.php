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
        Schema::create('paket_maskapai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paket_id')->nullable()
                ->constrained('paket')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('maskapai_id')->nullable()
                ->constrained('maskapai')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('nomor_penerbangan')->nullable();
            $table->string('nomor_pnr')->nullable();
            $table->string('kelas')->nullable();
            $table->integer('kuota')->nullable();
            $table->text('keterangan_penerbangan')->nullable();
            $table->float('total_harga', 16, 2)->nullable();
            $table->string('bandara_asal')->nullable();
            $table->string('bandara_tujuan')->nullable();
            $table->dateTime('waktu_keberangkatan')->nullable();
            $table->dateTime('waktu_kedatangan')->nullable();
            $table->string('status_penerbangan')->nullable();
            $table->enum('tipe_penerbangan', ['Langsung', 'Transit'])->nullable();
            $table->string('gate_penerbangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket_maskapai');
    }
};
