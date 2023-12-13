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
        Schema::create('cabang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perwakilan_id')->nullable()
                ->constrained('perwakilan')
                ->onUpdate('cascade')
                ->nullOnDelete();
            $table->foreignId('kantor_id')->nullable()
                ->constrained('kantor')
                ->onUpdate('cascade')
                ->nullOnDelete();
            $table->string('nama_ketua')->nullable();
            $table->string('kontak')->nullable();
            $table->string('surat_izin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cabang');
    }
};
