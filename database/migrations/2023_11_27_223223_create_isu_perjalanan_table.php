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
        Schema::create('isu_perjalanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grup_id')
                ->nullable()
                ->constrained('grup')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->text('masalah')->nullable(); // Deskripsi masalah atau isu perjalanan
            $table->text('solusi')->nullable(); // Solusi atau tindakan yang diambil terkait isu perjalanan
            $table->timestamp('tanggal_pelaporan')->nullable(); // Tanggal pelaporan isu perjalanan
            $table->timestamp('tanggal_penyelesaian')->nullable(); // Tanggal penyelesaian isu perjalanan
            $table->boolean('status')->default(false); // Status isu perjalanan (dalam penanganan atau sudah selesai)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('isu_perjalanan');
    }
};
