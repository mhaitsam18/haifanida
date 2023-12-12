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
        Schema::create('galeri', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paket_id')
                ->nullable()
                ->constrained('paket')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('nama')->nullable(); // Nama atau judul untuk galeri
            $table->text('deskripsi')->nullable(); // Deskripsi atau keterangan untuk galeri
            $table->string('file_path'); // Path atau URL ke file gambar atau video
            $table->enum('jenis', ['gambar', 'video'])->default('gambar'); // Jenis media (gambar atau video)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galeri');
    }
};
