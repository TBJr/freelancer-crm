<?php
namespace Tests\Feature;

use App\Models\Payment;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentTest extends TestCase
{
    use RefreshDatabase;

    public function test_payment_index()
    {
        // Create and authenticate a user
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create some payments
        Payment::factory()->count(5)->create();

        // Test the index route
        $response = $this->get(route('payments.index'));

        $response->assertStatus(200);
        $response->assertViewIs('payments.index');
    }

    public function test_payment_store()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $invoice = Invoice::factory()->create();

        $response = $this->post(route('payments.store'), [
            'invoice_id' => $invoice->id,
            'amount' => 500,
            'payment_date' => now()->toDateString(),
            'payment_method' => 'cash',
        ]);

        $response->assertRedirect(route('payments.index'));
        $this->assertDatabaseHas('payments', ['amount' => 500]);
    }

    public function test_payment_update()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $payment = Payment::factory()->create();

        $response = $this->put(route('payments.update', $payment), [
            'invoice_id' => $payment->invoice_id,
            'amount' => 700,
            'payment_method' => 'card',
            'payment_date' => now()->toDateString(),
        ]);

        $response->assertRedirect(route('payments.index'));
        $this->assertDatabaseHas('payments', ['amount' => 700]);
    }

    public function test_payment_delete()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $payment = Payment::factory()->create();

        $response = $this->delete(route('payments.destroy', $payment));

        $response->assertRedirect(route('payments.index'));
        $this->assertDatabaseMissing('payments', ['id' => $payment->id]);
    }
}
