<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('monitoring', function (Blueprint $table) {
            if (!Schema::hasColumn('monitoring', 'master_benih_id')) {
                $table->unsignedBigInteger('master_benih_id')->nullable()->after('tanggal');
                $table->foreign('master_benih_id')
                      ->references('id')
                      ->on('master_benihs')
                      ->onDelete('cascade');
            }
        });
    }

    public function down(): void
    {
        Schema::table('monitoring', function (Blueprint $table) {
            $table->dropForeign(['master_benih_id']);
            $table->dropColumn('master_benih_id');
        });
    }
};

