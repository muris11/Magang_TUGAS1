<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (DB::connection()->getDriverName() === 'pgsql') {
            DB::statement('CREATE INDEX barangs_nama_barang_pattern_idx ON barangs ((lower(nama_barang)) varchar_pattern_ops)');
            DB::statement('CREATE INDEX barangs_kode_barang_pattern_idx ON barangs ((lower(kode_barang)) varchar_pattern_ops)');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (DB::connection()->getDriverName() === 'pgsql') {
            DB::statement('DROP INDEX IF EXISTS barangs_nama_barang_pattern_idx');
            DB::statement('DROP INDEX IF EXISTS barangs_kode_barang_pattern_idx');
        }
    }
};
