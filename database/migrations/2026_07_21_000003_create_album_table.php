<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Singular table name matches this schema's convention (paket, hotel, galeri...)
        Schema::create('album', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('cover')->nullable();
            $table->timestamps();
        });

        Schema::table('galeri', function (Blueprint $table) {
            $table->foreignId('album_id')->nullable()->after('paket_id')
                ->constrained('album')
                ->onUpdate('cascade')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('galeri', function (Blueprint $table) {
            $table->dropConstrainedForeignId('album_id');
        });

        Schema::dropIfExists('album');
    }
};
