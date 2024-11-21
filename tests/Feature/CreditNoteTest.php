<?php
namespace Tests\Feature;

use App\Models\CreditNote;
use App\Models\Invoice;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreditNoteTest extends TestCase
{
    use RefreshDatabase;

    public function test_credit_note_index()
    {
        // Create and authenticate a user
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        // Seed some credit notes
        CreditNote::factory()->count(5)->create();

        // Access the index route
        $response = $this->get(route('credit_notes.index'));

        // Assertions
        $response->assertStatus(200);
        $response->assertViewIs('credit_notes.index');
        $response->assertViewHas('creditNotes'); // Ensure the view has the required data
    }

    public function test_credit_note_store()
    {
        $invoice = Invoice::factory()->create();

        $response = $this->post(route('credit_notes.store'), [
            'invoice_id' => $invoice->id,
            'amount' => 100,
            'reason' => 'Product returned',
        ]);

        $response->assertRedirect(route('credit_notes.index'));
        $this->assertDatabaseHas('credit_notes', ['amount' => 100]);
    }

    public function test_credit_note_update()
    {
        // Create a credit note with a related invoice
        $invoice = \App\Models\Invoice::factory()->create();
        $creditNote = \App\Models\CreditNote::factory()->create([
            'invoice_id' => $invoice->id,
        ]);

        // Perform the update with the required fields
        $response = $this->put(route('credit_notes.update', $creditNote), [
            'invoice_id' => $invoice->id, // Include the related invoice ID
            'amount' => 150,
            'reason' => 'Updated reason',
        ]);

        // Assert the response and database
        $response->assertRedirect(route('credit_notes.index'));
        $this->assertDatabaseHas('credit_notes', [
            'id' => $creditNote->id,
            'invoice_id' => $invoice->id,
            'amount' => 150,
            'reason' => 'Updated reason',
        ]);
    }

    public function test_credit_note_delete()
    {
        $creditNote = CreditNote::factory()->create();

        $response = $this->delete(route('credit_notes.destroy', $creditNote));

        $response->assertRedirect(route('credit_notes.index'));
        $this->assertDatabaseMissing('credit_notes', ['id' => $creditNote->id]);
    }
}
