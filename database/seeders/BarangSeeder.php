<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \Illuminate\Support\Facades\DB::disableQueryLog();

        $totalRecords = 1500000;
        $batchSize = 1000;
        $categories = ['Elektronik', 'Pakaian', 'Makanan', 'Minuman', 'Otomotif', 'Kesehatan', 'Kecantikan', 'Olahraga', 'Hiburan', 'Lainnya'];
        $now = now();

        for ($i = 0; $i < $totalRecords; $i += $batchSize) {
            $data = [];
            for ($j = 0; $j < $batchSize; $j++) {
                $currentIndex = $i + $j + 1;
                $data[] = [
                    'kode_barang' => 'BRG' . str_pad($currentIndex, 7, '0', STR_PAD_LEFT),
                    'nama_barang' => 'Barang ' . $currentIndex,
                    'kategori' => $categories[array_rand($categories)],
                    'stok' => rand(10, 1000),
                    'harga' => rand(1000, 1000000),
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
            \Illuminate\Support\Facades\DB::table('barangs')->insert($data);
        }
    }
}
