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

        Schema::table('berkas_pihak', function (Blueprint $table) {
            $table->foreignId('id_permintaan')
                ->nullable() // bisa disesuaikan, nullable jika data sebelumnya belum memiliki relasi
                ->constrained('permintaan_layanan', 'id_permintaan')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('berkas_pihak', function (Blueprint $table) {
            $table->dropForeign(['id_permintaan']);
            $table->dropColumn('id_permintaan');
        });
    }
};
