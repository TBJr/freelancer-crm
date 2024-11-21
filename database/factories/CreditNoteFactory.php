<?php

namespace Database\Factories;

use App\Models\CreditNote;
use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CreditNote>
 */
class CreditNoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'invoice_id' => Invoice::factory(), // Generate related invoice
            'amount' => $this->faker->randomFloat(2, 50, 500),
            'reason' => $this->faker->sentence,
        ];
    }
}
