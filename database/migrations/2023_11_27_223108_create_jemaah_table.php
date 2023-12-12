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
        Schema::create('jemaah', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemesanan_id')->nullable()
                ->constrained('pemesanan')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('grup_id')->nullable()
                ->constrained('grup')
                ->onUpdate('cascade')
                ->nullOnDelete();
            $table->foreignId('mahram_id')->nullable()
                ->constrained('jemaah')
                ->onUpdate('cascade')
                ->nullOnDelete();
            $table->string('nomor_ktp')->nullable();
            $table->string('nama_lengkap')->nullable();
            $table->string('nama_sesuai_paspor')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable();
            $table->enum('kewarganegaraan', ['WNI', 'WNA'])->nullable();
            $table->text('alamat')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('nomor_telepon')->nullable();
            $table->enum('tingkat_pendidikan', ['SD', 'SLTP', 'SLTA', 'D1/D2/D3', 'D4/S1', 'S2', 'S3'])->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('nomor_paspor')->nullable();
            $table->string('tempat_dikeluarkan')->nullable();
            $table->date('tanggal_dikeluarkan')->nullable();
            $table->date('tanggal_kadaluarsa')->nullable();
            $table->boolean('pernah_umroh')->nullable();
            $table->boolean('pernah_haji')->nullable();
            $table->enum('hubungan_mahram', ['Orang Tua', 'Anak', 'Suami', 'Saudara Kandung', 'Kakek', 'Cucu', 'Paman', 'Keponakan'])->nullable();
            $table->enum('golongan_darah', ['A', 'B', 'AB', 'O'])->nullable();
            $table->string('foto')->nullable();
            $table->string('nama_keluarga_terdekat')->nullable();
            $table->string('kontak_keluarga_terdekat')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jemaah');
    }
};
