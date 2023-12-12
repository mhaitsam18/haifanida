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
        Schema::create('berkas_jemaah', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jemaah_id')->nullable()
                ->constrained('jemaah')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('berkas_id')->nullable()
                ->constrained('berkas')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('file_path')->nullable();
            $table->enum('status', ['tertunda', 'diverifikasi', 'ditolak'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berkas_jemaah');
    }
};
