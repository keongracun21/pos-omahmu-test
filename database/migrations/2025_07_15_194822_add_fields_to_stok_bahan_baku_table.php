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
        Schema::table('stok_bahan_baku', function (Blueprint $table) {
            $table->string('satuan')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('ketersediaan')->default('Tersedia');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stok_bahan_baku', function (Blueprint $table) {
            $table->dropColumn(['satuan', 'keterangan', 'ketersediaan']);
        });
    }
};