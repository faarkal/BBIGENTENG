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
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_bibit');
            $table->string('nama_pemesan');
            $table->string('no_Telpon');
            $table->integer('jumlah_ikan');
            $table->decimal('total_harga', 15, 2)->nullable();
            $table->string('status')->default('Menunggu Konfirmasi'); // status: Menunggu, Diterima, Ditolak
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan');
    }
};
