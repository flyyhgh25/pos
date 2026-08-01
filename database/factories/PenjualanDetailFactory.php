<?php

namespace Database\Factories;

use App\Models\Barang;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PenjualanDetail>
 */
class PenjualanDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $barang = Barang::inRandomOrder()->first();
        $qty = $this->faker->numberBetween(1, 7);
        return [
            'penjualan_id' => Penjualan::factory(),
            'barang_id' => $barang->id,
            'qty' => $qty,
            'harga_saturan' => $barang->harga,
            'subtotal' => $barang->harga * $qty,
        ];
    }
}
