<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('monitoring', function (Blueprint $table) {
            $table->string('ukuran')->nullable()->after('bibit_awal');
            $table->integer('kematian_bibit')->nullable()->after('ukuran');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('monitoring', function (Blueprint $table) {
            //
        });
    }
};
