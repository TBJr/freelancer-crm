<?php
namespace Tests\Feature;

use App\Models\Invoice;
use App\Models\Item;
use App\Models\InvoiceItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InvoiceItemTest extends TestCase
{
    use RefreshDatabase;

    public function test_invoice_item_index()
    {
        $user = User::factory()->create(); // Create a user
        $this->actingAs($user); // Authenticate the user

        InvoiceItem::factory()->count(5)->create();

        $response = $this->get(route('invoice_items.index'));

        $response->assertStatus(200);
        $response->assertViewIs('invoice_items.index');
    }

    public function test_invoice_item_store()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $invoice = Invoice::factory()->create();
        $item = Item::factory()->create();

        $response = $this->post(route('invoice_items.store'), [
            'invoice_id' => $invoice->id,
            'item_id' => $item->id,
            'quantity' => 5,
            'price' => 20,
            'total' => 5 * 20, // Add the total field
        ]);

        $response->assertRedirect(route('invoice_items.index'));
        $this->assertDatabaseHas('invoice_items', [
            'quantity' => 5,
            'price' => 20,
            'total' => 100, // Ensure the total is stored correctly
        ]);
    }

    public function test_invoice_item_update()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create related models
        $invoice = Invoice::factory()->create();
        $item = Item::factory()->create();

        // Create an invoice item
        $invoiceItem = InvoiceItem::factory()->create([
            'invoice_id' => $invoice->id,
            'item_id' => $item->id,
        ]);

        // Perform the update
        $response = $this->put(route('invoice_items.update', $invoiceItem), [
            'invoice_id' => $invoice->id,
            'item_id' => $item->id,
            'quantity' => 10,
            'price' => 50,
            'total' => 10 * 50, // Add the total field
        ]);

        // Assert the update was successful
        $response->assertRedirect(route('invoice_items.index'));
        $this->assertDatabaseHas('invoice_items', [
            'invoice_id' => $invoice->id, // Match dynamically created invoice ID
            'item_id' => $item->id,       // Match dynamically created item ID
            'quantity' => 10,
            'price' => 50,
            'total' => 500,
        ]);
    }

    public function test_invoice_item_delete()
    {
        $invoiceItem = InvoiceItem::factory()->create();

        $response = $this->delete(route('invoice_items.destroy', $invoiceItem));

        $response->assertRedirect(route('invoice_items.index'));
        $this->assertDatabaseMissing('invoice_items', ['id' => $invoiceItem->id]);
    }
}
