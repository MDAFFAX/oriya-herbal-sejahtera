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
        // Drop the existing foreign key constraint
        Schema::table('beban_operasionals', function (Blueprint $table) {
            $table->dropForeign(['kode_akun']);
        });

        // Add the correct foreign key constraint
        Schema::table('beban_operasionals', function (Blueprint $table) {
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
        Schema::table('beban_operasionals', function (Blueprint $table) {
            $table->dropForeign(['kode_akun']);
        });
    }
};
