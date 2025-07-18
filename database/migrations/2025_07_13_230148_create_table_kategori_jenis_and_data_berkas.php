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
        Schema::create('kategori_layanan', function (Blueprint $table) {
            $table->id('id_kategori');
            $table->string('nama_kategori')->unique();
            $table->text('deskripsi_kategori')->nullable();
            $table->timestamps();
        });
        Schema::create('jenis_layanan', function (Blueprint $table) {
            $table->id('id_jenis');
            $table->foreignId('id_kategori')->nullable()->constrained('kategori_layanan','id_kategori')->nullOnDelete();
            $table->string('nama_jenis')->unique();
            $table->text('deskripsi_jenis')->nullable();
            $table->timestamps();
        });
        Schema::create('kategori_pihak', function (Blueprint $table) {
            $table->id('id_kategori_pihak');
            $table->foreignId('id_jenis')->nullable()->constrained('jenis_layanan', 'id_jenis')->nullOnDelete();
            $table->string('nama_kategori_pihak');
            $table->timestamps();
        });
        Schema::create('data_berkas', function (Blueprint $table) {
            $table->id('id_berkas');
            $table->foreignId('id_jenis')->nullable()->constrained('jenis_layanan','id_jenis')->nullOnDelete();
            $table->foreignId('id_kategori_pihak')->nullable()->constrained('kategori_pihak','id_kategori_pihak')->nullOnDelete();
            $table->string('nama_berkas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_kategori_jenis_and_data_berkas');
    }
};
