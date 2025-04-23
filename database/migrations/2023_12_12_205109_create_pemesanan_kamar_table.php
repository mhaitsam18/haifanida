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
        Schema::create('pemesanan_kamar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemesanan_id')->nullable()
                ->constrained('pemesanan')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('tipe_kamar')->nullable(); // misal tipe kamar quad ( orang)
            $table->string('jumlah_pengisi')->nullable(); //misal diisi hanya 3 orang
            $table->float('harga', 16, 2)->nullable(); //misal diisi hanya 3 orang
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan_kamar');
    }
};
