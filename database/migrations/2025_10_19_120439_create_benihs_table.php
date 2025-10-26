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
        Schema::create('benihs', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_benih'); // jenis ikan
            $table->date('bulan_menetas'); // bulan menetas
            $table->integer('jumlah_benih'); // total benih
            $table->decimal('ukuran_benih', 5, 2); // ukuran cm
            $table->integer('restocking')->default(0);
            $table->decimal('kematian_benih', 5, 2)->default(0); // persen
            $table->decimal('harga_benih', 15, 2);
            $table->integer('jumlah_benih_akhir')->default(0); // hasil akhir
            $table->decimal('total_harga_akhir', 15, 2)->default(0); // total harga akhir
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('benihs');
    }
};
