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
        Schema::create('ekstra', function (Blueprint $table) {
            $table->id();
            $table->string('nama_ekstra')->nullable();
            $table->float('harga_default', 16, 2)->nullable();
            $table->enum('jenis_ekstra', ['perlengkapan', 'jasa', 'permintaan kamar', 'tipe kamar', 'pesawat'])->nullable();
            $table->text('deskripsi')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ekstra');
    }
};
