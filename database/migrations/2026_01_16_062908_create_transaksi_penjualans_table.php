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
        Schema::create('transaksi_penjualans', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_transaksi')->unique();
            $table->date('tanggal');
            $table->string('nama_pelanggan');
            $table->enum('metode_pembayaran', ['Tunai', 'Transfer']);
            $table->decimal('total_bayar', 15, 2);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama_toko')->default('Oriya Herbal Sejahtera');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_penjualans');
    }
};
