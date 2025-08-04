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
        Schema::create('stok_bahan_baku', function (Blueprint $table) {
            $table->id('id_bahan');
            $table->string('nama_bahan');
            $table->integer('stok');
            $table->string('satuan');
            $table->string('keterangan')->nullable();
            $table->string('ketersediaan')->default('Tersedia');
            $table->integer('harga_total')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stok_bahan_baku', function (Blueprint $table) {
            $table->dropColumn('harga_total');
        });
        Schema::dropIfExists('stok_bahan_baku');
    }
}; 