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
        Schema::create('maskapai', function (Blueprint $table) {
            $table->id();
            $table->string('kode_maskapai')->unique(); // Kode unik untuk maskapai
            $table->string('nama_maskapai')->nullable(); // Nama maskapai
            $table->string('negara_asal')->nullable(); // Negara asal maskapai
            $table->string('logo')->nullable(); // Path/logo file untuk logo maskapai (bisa bernilai null)
            $table->text('deskripsi')->nullable(); // Deskripsi maskapai (bisa bernilai null)
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maskapai');
    }
};
