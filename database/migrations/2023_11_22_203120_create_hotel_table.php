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
        Schema::create('hotel', function (Blueprint $table) {
            $table->id();
            $table->string('kode_hotel')->nullable();
            $table->string('nama_hotel')->nullable();
            $table->enum('bintang', ['0', '1', '2', '3', '4', '5', '6', '7'])->nullable();
            $table->string('bintang_setaraf')->nullable();
            $table->string('kota')->nullable();
            $table->string('negara')->nullable();
            $table->string('alamat')->nullable();
            $table->string('link_gmaps')->nullable();
            $table->string('gambar')->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotel');
    }
};
