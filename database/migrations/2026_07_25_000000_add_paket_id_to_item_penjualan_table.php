<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Lepas dulu foreign key produk_id supaya kolomnya bisa diubah jadi nullable
        Schema::table('item_penjualan', function (Blueprint $table) {
            $table->dropForeign(['produk_id']);
        });

        // Ubah produk_id jadi nullable (tanpa perlu paket doctrine/dbal)
        DB::statement('ALTER TABLE item_penjualan MODIFY produk_id BIGINT UNSIGNED NULL');

        Schema::table('item_penjualan', function (Blueprint $table) {
            // Pasang lagi foreign key produk_id (sekarang nullable)
            $table->foreign('produk_id')->references('id')->on('produk');

            // Kolom baru: referensi ke paket, nullable juga
            $table->foreignId('paket_id')
                ->nullable()
                ->after('produk_id')
                ->constrained('paket', 'id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('item_penjualan', function (Blueprint $table) {
            $table->dropForeign(['paket_id']);
            $table->dropColumn('paket_id');

            $table->dropForeign(['produk_id']);
        });

        DB::statement('ALTER TABLE item_penjualan MODIFY produk_id BIGINT UNSIGNED NOT NULL');

        Schema::table('item_penjualan', function (Blueprint $table) {
            $table->foreign('produk_id')->references('id')->on('produk');
        });
    }
};