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
        Schema::create('detail_pembayarans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('id_barang'); // Foreign key ke tabel barangs
            $table->unsignedBigInteger('id_keranjang'); // Foreign key ke tabel keranjangs
            $table->unsignedBigInteger('id_pembayaran'); // Foreign key ke tabel pembayarans
            $table->integer('jumlah_barang');
            $table->decimal('harga_barang');
            $table->decimal('subtotal');
            // Foreign key constraints
            $table->foreign('id_barang')->references('id')->on('barangs')->onDelete('cascade');
            $table->foreign('id_keranjang')->references('id')->on('keranjangs')->onDelete('cascade');
            $table->foreign('id_pembayaran')->references('id')->on('pembayarans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pembayarans');
    }
};
