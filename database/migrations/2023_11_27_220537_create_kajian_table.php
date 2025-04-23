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
        Schema::create('kajian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->nullable()
                ->constrained('author')
                ->onUpdate('cascade')
                ->nullOnDelete();
            $table->string('slug')->nullable()->unique();
            $table->string('judul')->nullable();
            $table->string('kategori')->nullable();
            $table->text('isi_kajian')->nullable();
            $table->boolean('published')->default(false); // Untuk menandai apakah kajian sudah dipublikasikan
            $table->timestamp('tanggal_publikasi')->nullable(); // Tanggal dan waktu publikasi
            $table->integer('jumlah_pembaca')->default(0);
            $table->text('sumber_referensi')->nullable();
            $table->string('gambar_sampul')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kajian');
    }
};
