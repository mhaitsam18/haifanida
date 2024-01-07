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
            $table->foreignId('kantor_id')->nullable()
                ->constrained('kantor')
                ->onUpdate('cascade')
                ->nullOnDelete();

            // Nama paket
            $table->string('nama_paket')->nullable();

            // Destinasi atau tujuan dari paket wisata
            $table->string('destinasi')->nullable();

            $table->enum('jenis_paket', ['umroh', 'haji', 'wisata halal'])->nullable();

            // Durasi paket wisata, misalnya berapa hari
            $table->integer('durasi')->nullable();

            // Harga paket wisata
            $table->float('harga', 16, 2)->nullable();

            // Fasilitas yang disertakan dalam paket
            $table->text('fasilitas')->nullable();

            // Informasi tambahan atau deskripsi paket
            $table->text('deskripsi')->nullable();

            $table->text('tempat_keberangkatan')->nullable();
            $table->text('tempat_kepulangan')->nullable();

            // Tanggal mulai dan selesai paket
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->string('gambar')->nullable();

            // Kolom untuk mengatur status publish
            $table->timestamp('published_at')->nullable();

            $table->timestamps();
            $table->softDeletes();
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
