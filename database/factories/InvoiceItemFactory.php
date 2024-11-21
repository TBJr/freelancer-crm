<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<InvoiceItem>
 */
class InvoiceItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $quantity = $this->faker->numberBetween(1, 20);
        $price = $this->faker->randomFloat(2, 10, 500);

        return [
            'invoice_id' => Invoice::factory(),
            'item_id' => Item::factory(),
            'quantity' => $quantity,
            'price' => $price,
            'total' => $quantity * $price, // Calculate total here
        ];
    }
}
