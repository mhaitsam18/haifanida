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
        Schema::create('bus_jemaah', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bus_id')->nullable()
                ->constrained('bus')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('jemaah_id')->nullable()
                ->constrained('jemaah')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('nomor_kursi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bus_jemaah');
    }
};
