<?php

namespace Database\Factories;

use App\Models\Pembelian;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Pembelian>
 */
class PembelianFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $supplier = Supplier::inRandomOrder()->first();
        return [
            'no_transaksi' => 'TRX-PB-' . now()->format('Ymd') . '-' . strtoupper(Str::random(4)),
            'tanggal' => $this->faker->dateTimeBetween('-30 days', 'now'),
            'supplier_id' => $supplier->id,
            'total_harga' => 0,
            'user_id' => User::factory()
        ];
    }
}
