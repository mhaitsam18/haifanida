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
        Schema::create('paket', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_madinah_id')->constrained('hotel');
            $table->foreignId('hotel_mekah_id')->constrained('hotel');
            $table->foreignId('maskapai_id')->constrained('maskapai');
            $table->string('nama');
            $table->enum('jenis', ['umrah', 'haji']);
            $table->integer('harga');
            $table->date('keberangkatan');
            $table->unsignedTinyInteger('jumlah_hari');
            $table->unsignedInteger('stok');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket');
    }
};
