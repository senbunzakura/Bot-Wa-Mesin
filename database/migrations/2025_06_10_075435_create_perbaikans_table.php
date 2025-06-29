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
        Schema::create('perbaikans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('laporan_perbaikan_id');
            $table->text('keterangan');
            $table->enum('prioritas', ['Low', 'Medium', 'High', 'Critical'])->default('Medium');
            $table->string('lokasi');
            $table->date('tanggal_pekerjaan');

            $table->unsignedBigInteger('mekanik_id')->nullable();
            $table->enum('status', ['Dijadwalkan', 'Dalam Proses', 'Tertunda', 'Selesai'])->default('Dijadwalkan');
            $table->text('catatan_selesai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->text('foto')->nullable();
            $table->timestamps();

            $table->foreign('laporan_perbaikan_id')->references('id')->on('laporan_kerusakans')->onDelete('cascade');
            $table->foreign('mekanik_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perbaikans');
    }
};
