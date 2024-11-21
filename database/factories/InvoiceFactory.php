<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
            'total' => $this->faker->randomFloat(2, 100, 5000),
            'tax' => $this->faker->randomFloat(2, 0, 100),
            'status' => $this->faker->randomElement(['pending', 'paid', 'cancelled']),
        ];
    }
}