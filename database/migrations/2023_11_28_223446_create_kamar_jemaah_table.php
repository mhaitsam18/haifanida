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
        Schema::create('kamar_jemaah', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kamar_id')->nullable()
                ->constrained('kamar')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('jemaah_id')->nullable()
                ->constrained('jemaah')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamar_jemaah');
    }
};
