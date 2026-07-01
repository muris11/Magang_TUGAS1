<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barang>
 */
class BarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kode_barang' => 'BRG-' . strtoupper(Str::random(8)),
            'nama_barang' => $this->faker->words(3, true),
            'kategori' => $this->faker->randomElement(['Elektronik', 'Pakaian', 'Makanan', 'Minuman', 'Perabotan']),
            'stok' => $this->faker->numberBetween(1, 1000),
            'harga' => $this->faker->numberBetween(1000, 10000000),
        ];
    }
}
