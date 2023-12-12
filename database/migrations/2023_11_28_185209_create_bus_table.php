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
        Schema::create('bus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paket_id')->nullable()
                ->constrained('paket')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            //detail bus
            $table->string('nomor_rombongan')->nullable(); // Nomor rombongan
            $table->string('nomor_polisi')->nullable(); // Nomor polisi bus
            $table->string('merek')->nullable(); // Merek atau jenis bus
            $table->string('kapasitas')->nullable(); // Kapasitas maksimum penumpang bus
            $table->text('fasilitas')->nullable(); // Fasilitas yang disediakan di dalam bus
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bus');
    }
};
