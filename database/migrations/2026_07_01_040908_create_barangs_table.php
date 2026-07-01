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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang', 50)->unique();
            $table->string('nama_barang', 255);
            $table->string('kategori', 100);
            $table->integer('stok')->default(0);
            $table->decimal('harga', 12, 2)->default(0);
            $table->timestamps();

            $table->index('kode_barang');
            $table->index('nama_barang');
            $table->index('kategori');
            $table->index(['kategori', 'nama_barang']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
