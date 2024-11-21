<?php
namespace Tests\Feature;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_index()
    {
       // Create a user
       $user = User::factory()->create();

       // Act as the authenticated user
       $this->actingAs($user);

       // Create some customers
       Customer::factory()->count(5)->create();

       // Make the GET request
       $response = $this->get(route('customers.index'));

       // Assert the response
       $response->assertStatus(200);
       $response->assertViewIs('customers.index');
       $response->assertViewHas('customers');
    }

    public function test_customer_store()
    {
        $response = $this->post(route('customers.store'), [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '123456789',
            'address' => '123 Main Street',
        ]);

        $response->assertRedirect(route('customers.index'));
        $this->assertDatabaseHas('customers', ['email' => 'john@example.com']);
    }

    public function test_customer_update()
    {
        $customer = Customer::factory()->create();

        $response = $this->put(route('customers.update', $customer), [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'phone' => '987654321',
            'address' => '456 Elm Street',
        ]);

        $response->assertRedirect(route('customers.index'));
        $this->assertDatabaseHas('customers', ['email' => 'jane@example.com']);
    }

    public function test_customer_delete()
    {
        $customer = Customer::factory()->create();

        $response = $this->delete(route('customers.destroy', $customer));

        $response->assertRedirect(route('customers.index'));
        $this->assertDatabaseMissing('customers', ['id' => $customer->id]);
    }
}
