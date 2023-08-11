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
        Schema::table('jemaah', function(Blueprint $table) {
            $table->string('nama')
                ->after('jenis_kelamin');
            $table->string('no_kamar', 50)
                ->after('nama')
                ->nullable();
            $table->string('no_seat', 50)
                ->after('no_kamar')
                ->nullable();
        });

        Schema::table('pesanan', function(Blueprint $table) {
            $table->dropColumn('no_kamar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jemaah', function(Blueprint $table) {
            $table->dropColumn('nama');
            $table->dropColumn('no_kamar');
            $table->dropColumn('no_seat');
        });

        Schema::table('pesanan', function(Blueprint $table) {
            $table->string('no_kamar', 50)->nullable();
        });
    }
};
