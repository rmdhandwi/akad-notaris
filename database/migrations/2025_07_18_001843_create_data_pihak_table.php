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

        Schema::create('data_pihak', function (Blueprint $table) {
            $table->id('id_pihak'); // Primary Key
            $table->foreignId('user_id')->nullable()->constrained('users', 'user_id')->cascadeOnDelete(); // FK ke tabel klien sebagai pihak_1 (optional)
            $table->foreignId('id_pihak_terkait')->nullable()->constrained('data_pihak', 'id_pihak')->cascadeOnDelete();    // FK self-reference (optional)
            $table->foreignId('id_kategori_pihak')->constrained('kategori_pihak', 'id_kategori_pihak')->cascadeOnDelete();
            $table->string('nama_pihak');
            $table->string('nik_pihak', 20)->nullable();
            $table->string('no_hp_pihak', 20)->nullable();
            $table->text('alamat_pihak')->nullable();
            $table->string('tipe_pihak')->nullable(); // Bisa juga pakai string jika mau fleksibel

            $table->timestamps();
        });
        Schema::create('permintaan_layanan', function (Blueprint $table) {
            $table->id('id_permintaan');
            $table->foreignId('id_pihak')->constrained('data_pihak', 'id_pihak')->cascadeOnDelete(); // pihak pengaju utama
            $table->foreignId('id_staf')->nullable()->constrained('users', 'user_id')->nullOnDelete();
            $table->foreignId('id_jadwal')->nullable()->constrained('data_jadwal', 'id_jadwal')->nullOnDelete();
            $table->timestamp('tgl_permintaan')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
        Schema::create('berkas_pihak', function (Blueprint $table) {
            $table->id('id_berkas_pihak');
            $table->foreignId('id_permintaan')
                ->nullable() // bisa disesuaikan, nullable jika data sebelumnya belum memiliki relasi
                ->constrained('permintaan_layanan', 'id_permintaan')
                ->cascadeOnDelete();
            $table->foreignId('id_berkas')->constrained('data_berkas', 'id_berkas')->cascadeOnDelete();
            $table->foreignId('id_pihak')->constrained('data_pihak', 'id_pihak')->cascadeOnDelete();
            $table->string('berkas_path')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pihak');
        Schema::dropIfExists('berkas_pihak');
        Schema::dropIfExists('permintaan_layanan');
    }
};
