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
        Schema::table('penjualan_details', function (Blueprint $table) {
            $table->renameColumn('harga_saturan', 'harga_satuan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penjualan_details', function (Blueprint $table) {
            $table->renameColumn('harga_satuan', 'harga_saturan');
        });
    }
};
