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
        Schema::create('kantor', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kantor')->nullable();
            $table->string('alamat_kantor')->nullable();
            $table->foreignId('kabupaten_id')->nullable()
                ->constrained('kabupaten')
                ->onUpdate('cascade')
                ->nullOnDelete();
            $table->string('kecamatan')->nullable();
            $table->string('kode_pos')->nullable();
            $table->enum('jenis_kantor', ['pusat', 'perwakilan', 'cabang', 'agen']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kantor');
    }
};
