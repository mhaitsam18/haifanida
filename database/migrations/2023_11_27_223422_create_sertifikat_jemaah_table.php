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
        Schema::create('sertifikat_jemaah', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jemaah_id')->nullable()
                ->constrained('jemaah')
                ->onUpdate('cascade')
                ->nullOnDelete();
            $table->string('nomor_sertifikat')->nullable();
            $table->date('tanggal_penerbitan')->nullable();
            $table->date('tanggal_kadaluarsa')->nullable();
            $table->string('jenis_sertifikat')->nullable();
            $table->string('sertifikat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sertifikat_jemaah');
    }
};
