<?php

namespace Database\Factories;

use App\Models\Penjualan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Penjualan>
 */
class PenjualanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'no_transaksi' => 'TRX-PJ-' . now()->format('Ymd') . '-' . strtoupper(Str::random(4)),
            'tanggal' => $this->faker->dateTimeBetween('-7 days', 'now'),
            'total_harga' => 0,
            'user_id' => User::factory()
        ];
    }
}
