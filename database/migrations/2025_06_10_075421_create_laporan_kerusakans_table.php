<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laporan_kerusakans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_laporan')->unique();
            $table->string('nomor_whatsapp')->nullable();
            $table->unsignedBigInteger('mesin_id')->nullable();
            $table->text('isi_laporan');
            $table->enum('status', ['Diterima', 'Diproses', 'Selesai'])->default('diterima');
            $table->foreign('mesin_id')->references('id')->on('mesins')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_kerusakans');
    }
};
