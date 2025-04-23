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
        Schema::create('referal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()
                ->constrained('users')
                ->onUpdate('cascade')
                ->nullOnDelete();
            $table->string('kode_referal')->nullable();
            $table->integer('jumlah_pengguna_referal')->default(0); // Jumlah pengguna yang mendaftar melalui referal ini
            $table->float('bonus_referal', 16, 2)->default(0); // Bonus yang diberikan untuk setiap pengguna yang mendaftar melalui referal ini
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referal');
    }
};
