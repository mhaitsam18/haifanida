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
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paket_id')->nullable()
                ->constrained('paket')
                ->onUpdate('cascade')
                ->nullOnDelete();
            // $table->foreignId('user_id')->nullable()
            //     ->constrained('users')
            //     ->onUpdate('cascade')
            //     ->nullOnDelete();
            $table->foreignId('agen_id')->nullable()
                ->constrained('agen')
                ->onUpdate('cascade')
                ->nullOnDelete();
            $table->foreignId('member_id')->nullable()
                ->constrained('member')
                ->onUpdate('cascade')
                ->nullOnDelete();
            $table->foreignId('admin_id')->nullable()
                ->constrained('admin')
                ->onUpdate('cascade')
                ->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan');
    }
};
