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
        Schema::create('staf_details', function (Blueprint $table) {
            $table->id('staf_id');
            $table->string('nik_staf');
            $table->string('nama_staf');
            $table->timestamps();
        });
        Schema::create('notaris_details', function (Blueprint $table) {
            $table->id('notaris_id');
            $table->string('nomor_jabatan_notaris');
            $table->string('nama_notaris');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staf_details');
        Schema::dropIfExists('notaris_details');
    }
};
