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
        Schema::create('grup', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paket_id')->nullable()
                ->constrained('paket')
                ->onUpdate('cascade')
                ->nullOnDelete();
            $table->foreignId('agen_id')->nullable()
                ->constrained('agen')
                ->onUpdate('cascade')
                ->nullOnDelete();
            $table->string('nama_grup')->nullable();
            $table->text('keterangan_grup')->nullable();
            $table->string('status_grup')->nullable();
            $table->integer('kuota_grup')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grup');
    }
};
