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
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grup_id')->nullable()
                ->constrained('grup')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('nama_agenda');
            $table->string('lokasi');
            $table->dateTime('waktu_mulai');
            $table->dateTime('waktu_selesai');
            $table->text('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};
