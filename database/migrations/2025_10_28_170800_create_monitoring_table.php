<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {


    public function up()
    {

        Schema::create('monitoring', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->unsignedBigInteger('master_benih_id'); // ubah di sini
            $table->string('kolam');
            $table->integer('bibit_awal')->default(0);
            $table->timestamps();

            // foreign key ke master_benihs
            $table->foreign('master_benih_id')
                  ->references('id')
                  ->on('master_benihs')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('monitoring');
    }
};
