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
        Schema::create('master_benihs', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_ikan');
            $table->integer('jumlah_benih')->default(0);
            $table->decimal('ukuran', 5, 2)->nullable();
            $table->integer('restocking')->default(0);
            $table->decimal('harga_perekor', 15, 2)->nullable();
            $table->decimal('kematian_benih', 5, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_benihs');
    }
};
