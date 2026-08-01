<?php

namespace Database\Factories;

use App\Models\Barang;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Barang>
 */
class BarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    private array $namaProduk = [
        [
            'nama' => 'Gula Pasir 1Kg',
            'harga' => 16000
        ],
        [
            'nama' => 'Mie Sedap Goreng',
            'harga' => 3500
        ],
        [
            'nama' => 'Tepung Terigu 1Kg',
            'harga' => 20000
        ],

        [
            'nama' => 'Roti Tawar',
            'harga' => 11000
        ],
        [
            'nama' => 'Teh Celup',
            'harga' => 9000
        ],
        [
            'nama' => 'Kopi Kapal Api',
            'harga' => 20000
        ],
        [
            'nama' => 'Gula Pasir 1Kg',
            'harga' => 18000
        ],
        [
            'nama' => 'Gula Merah 1Kg',
            'harga' => 25000
        ],
        [
            'nama' => 'Minyak 1 Liter',
            'harga' => 18000
        ],
        [
            'nama' => 'Garam',
            'harga' => 12000,
        ],
        [
            'nama' => 'Telur Bebek 1Kg',
            'harga' => 35000
        ],
        [
            'nama' => 'Telur Ayam 1Kg',
            'harga' => 28000
        ],
        [
            'nama' => 'Beras 1Kg',
            'harga' => 15000
        ],
        [
            'nama' => 'Kecap Bango',
            'harga' => 8000
        ],
        [
            'nama' => 'Tepung Tapioka 1Kg',
            'harga' => 25000
        ],
    ];
    public function definition(): array
    {
        $produk = $this->faker->unique()->randomElement($this->namaProduk);
        return [
            'kode_barang' => 'BRG-' . $this->faker->unique()->numerify('####'),
            'nama_barang' => $produk['nama'],
            'tanggal_expired' => $this->faker->dateTimeBetween('+12 months', '+24 months'),
            'stock' => $this->faker->numberBetween(50, 300),
            'harga' => $produk['harga']
        ];
    }
}
