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
        Schema::create('member', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
            $table->string('email')->nullable();
            $table->enum('tingkat_pendidikan', ['SD', 'SLTP', 'SLTA', 'D1/D2/D3', 'D4/S1', 'S2', 'S3'])->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('nomor_paspor')->nullable();
            $table->string('tempat_dikeluarkan')->nullable();
            $table->date('tanggal_dikeluarkan')->nullable();
            $table->date('tanggal_kadaluarsa')->nullable();
            $table->boolean('pernah_umroh')->nullable();
            $table->boolean('pernah_haji')->nullable();
            $table->enum('golongan_darah', ['A', 'B', 'AB', 'O'])->nullable();
            $table->string('foto')->nullable();
            $table->string('nama_keluarga_terdekat')->nullable();
            $table->string('kontak_keluarga_terdekat')->nullable();
            $table->boolean('is_active')->default(1)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member');
    }
};
