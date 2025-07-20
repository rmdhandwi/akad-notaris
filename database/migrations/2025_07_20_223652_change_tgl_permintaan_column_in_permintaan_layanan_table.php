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
        Schema::table('permintaan_layanan', function (Blueprint $table) {
            // Ubah kolom menjadi date, pastikan dropTimestamps tidak digunakan jika ingin mempertahankan kolom created_at dan updated_at
            $table->date('tgl_permintaan')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permintaan_layanan', function (Blueprint $table) {
            //
        });
    }
};
