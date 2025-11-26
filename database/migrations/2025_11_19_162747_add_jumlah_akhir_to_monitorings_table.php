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
        Schema::table('monitoring', function (Blueprint $table) {
            // Menambahkan kolom jumlah_akhir setelah kematian_bibit
            $table->integer('jumlah_akhir')->nullable()->after('kematian_bibit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('monitoring', function (Blueprint $table) {
            // Menghapus kolom jumlah_akhir
            $table->dropColumn('jumlah_akhir');
        });
    }
};
