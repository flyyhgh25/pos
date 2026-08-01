<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'no_supplier' => 'SUP-' . $this->faker->unique()->numerify('###'),
            'nama' => 'PT ' . $this->faker->company(),
            'pic' => $this->faker->name(),
            'alamat' => $this->faker->address()
        ];
    }
}
