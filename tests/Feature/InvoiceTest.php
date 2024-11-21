<?php
namespace Tests\Feature;

use App\Models\Invoice;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InvoiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_invoice_index()
    {
        // Create a user and log them in
        $user = User::factory()->create();
        $this->actingAs($user);

        // Generate some invoices
        Invoice::factory()->count(5)->create();

        // Make the request
        $response = $this->get(route('invoices.index'));

        // Assert the response
        $response->assertStatus(200);
        $response->assertViewIs('invoices.index');
    }

    public function test_invoice_store()
    {
        $customer = Customer::factory()->create();

        $response = $this->post(route('invoices.store'), [
            'customer_id' => $customer->id,
            'total' => 1000,
            'tax' => 100,
            'status' => 'pending',
        ]);

        $response->assertRedirect(route('invoices.index'));
        $this->assertDatabaseHas('invoices', ['total' => 1000, 'tax' => 100]);
    }

    public function test_invoice_update()
    {
        // Create a user and log them in
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create related models
        $customer = Customer::factory()->create();
        $invoice = Invoice::factory()->create();

        // Perform the update
        $response = $this->put(route('invoices.update', $invoice), [
            'customer_id' => $customer->id, // Add a valid customer_id
            'total' => 2000,
            'tax' => 200,
            'status' => 'paid',
        ]);

        // Assert the update was successful
        $response->assertRedirect(route('invoices.index'));
        $this->assertDatabaseHas('invoices', [
            'id' => $invoice->id,
            'customer_id' => $customer->id, // Ensure customer_id is updated
            'total' => 2000,
            'status' => 'paid',
        ]);
    }

    public function test_invoice_delete()
    {
        $invoice = Invoice::factory()->create();

        $response = $this->delete(route('invoices.destroy', $invoice));

        $response->assertRedirect(route('invoices.index'));
        $this->assertDatabaseMissing('invoices', ['id' => $invoice->id]);
    }
}
