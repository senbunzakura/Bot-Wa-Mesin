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
        Schema::create('perawatans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_perawatan')->unique();
            $table->unsignedBigInteger('mesin_id');
            $table->enum('prioritas', ['Low', 'Medium', 'High', 'Critical'])->default('Medium');
            $table->date('tanggal_pekerjaan');
            $table->text('keterangan')->nullable();
            $table->unsignedBigInteger('teknisi_id');
            $table->enum('status', ['Dalam Pengerjaan', 'Selesai'])->default('Dalam Pengerjaan');
            $table->text('catatan_selesai')->nullable();
            $table->date('selesai_pada')->nullable();

            $table->timestamps();

            $table->foreign('mesin_id')->references('id')->on('mesins')->onDelete('cascade');
            $table->foreign('teknisi_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perawatans');
    }
};
