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
        Schema::create('jurnal_umums', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('nama_akun');
            $table->string('ref'); // kode_akun dari COA
            $table->decimal('debet', 15, 2)->default(0);
            $table->decimal('kredit', 15, 2)->default(0);
            $table->foreignId('transaksi_penjualan_id')->nullable()->constrained('transaksi_penjualans')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jurnal_umums');
    }
};
