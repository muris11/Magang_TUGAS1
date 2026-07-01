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
        DB::statement('CREATE INDEX barangs_nama_id_idx ON barangs (nama_barang, id);');
        DB::statement('CREATE INDEX barangs_kategori_id_idx ON barangs (kategori, id);');
        DB::statement('CREATE INDEX barangs_stok_id_idx ON barangs (stok, id);');
        
        // We already created harga_id_idx manually via tinker, so IF NOT EXISTS would be better, but Postgres < 9.5 doesn't support CREATE INDEX IF NOT EXISTS natively for all cases.
        // We can just create it if it's missing, but we'll try catching the exception or just dropping it first if it exists.
        DB::statement('DROP INDEX IF EXISTS barangs_harga_id_idx;');
        DB::statement('CREATE INDEX barangs_harga_id_idx ON barangs (harga, id);');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP INDEX IF EXISTS barangs_nama_id_idx;');
        DB::statement('DROP INDEX IF EXISTS barangs_kategori_id_idx;');
        DB::statement('DROP INDEX IF EXISTS barangs_stok_id_idx;');
        DB::statement('DROP INDEX IF EXISTS barangs_harga_id_idx;');
    }
};
