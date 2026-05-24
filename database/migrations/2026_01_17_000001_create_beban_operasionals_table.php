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
        Schema::create('beban_operasionals', function (Blueprint $table) {
            $table->id();
            $table->string('kode_akun');
            $table->string('nama_akun');
            $table->decimal('nominal', 15, 2);
            $table->date('tanggal_pengeluaran');
            $table->timestamps();

            // Foreign key ke COA
            $table->foreign('kode_akun')
                ->references('kode_akun')
                ->on('coas')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beban_operasionals');
    }
};
