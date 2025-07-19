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
            $table->foreignId('id_jenis')
            ->after('id_permintaan') // letakkan setelah kolom `id`, bisa disesuaikan
            ->constrained('jenis_layanan', 'id_jenis')
            ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permintaan_layanan', function (Blueprint $table) {
            //
            $table->dropForeign(['id_jenis']);
            $table->dropColumn('id_jenis');
        });
    }
};
