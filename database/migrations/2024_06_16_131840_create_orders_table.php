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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->dateTime('tanggal')->nullable();
            $table->string('no_transaksi');
            $table->string('outlet');
            $table->string('nomor_ref');
            $table->string('pelanggan');
            $table->string('produk');
            $table->integer('qty');
            $table->decimal('subtotal', 15, 2);
            $table->decimal('pajak', 15, 2);
            $table->decimal('service_charge', 15, 2);
            $table->decimal('total', 15, 2);
            $table->decimal('dibayar', 15, 2);
            $table->date('tgl_terakhir_dibayar')->nullable();
            $table->decimal('sisa_tagihan', 15, 2);
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
