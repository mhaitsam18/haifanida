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
        Schema::table('paket', function(Blueprint $table) {
            $table->dropColumn('harga');

            $table->integer('harga_single')
                ->after('jenis');
            $table->integer('harga_couple')
                ->after('harga_single');
            $table->integer('harga_quad')
                ->after('harga_quad');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('paket', function(Blueprint $table) {
            $table->integer('harga')
                ->after('jenis');
        });
    }
};
