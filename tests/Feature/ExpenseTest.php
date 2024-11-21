<?php
namespace Tests\Feature;

use App\Models\Expense;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExpenseTest extends TestCase
{
    use RefreshDatabase;

    public function test_expense_index()
    {
        // Create a user and authenticate
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create expenses
        Expense::factory()->count(5)->create();

        // Make the request
        $response = $this->get(route('expenses.index'));

        // Assert the response
        $response->assertStatus(200);
        $response->assertViewIs('expenses.index');
        $response->assertViewHas('expenses'); // Optional: Ensure 'expenses' is passed to the view
    }

    public function test_expense_store()
    {
        $response = $this->post(route('expenses.store'), [
            'category' => 'Office Supplies',
            'amount' => 100,
            'description' => 'Stationery purchase',
        ]);

        $response->assertRedirect(route('expenses.index'));
        $this->assertDatabaseHas('expenses', ['category' => 'Office Supplies']);
    }

    public function test_expense_update()
    {
        $expense = Expense::factory()->create();

        $response = $this->put(route('expenses.update', $expense), [
            'category' => 'Travel',
            'amount' => 500,
        ]);

        $response->assertRedirect(route('expenses.index'));
        $this->assertDatabaseHas('expenses', ['category' => 'Travel']);
    }

    public function test_expense_delete()
    {
        $expense = Expense::factory()->create();

        $response = $this->delete(route('expenses.destroy', $expense));

        $response->assertRedirect(route('expenses.index'));
        $this->assertDatabaseMissing('expenses', ['id' => $expense->id]);
    }
}
