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
        Schema::create('testimoni', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jemaah_id')->nullable()
                ->constrained('jemaah')
                ->onUpdate('cascade')
                ->nullOnDelete();
            $table->text('isi_testimoni')->nullable();
            $table->integer('rating')->nullable(); // misalnya rating dari 1-5
            $table->boolean('disetujui')->default(false); // status apakah testimoni disetujui atau belum
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimoni');
    }
};
