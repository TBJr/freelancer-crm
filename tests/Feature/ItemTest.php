<?php
namespace Tests\Feature;

use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemTest extends TestCase
{
    use RefreshDatabase;

    public function test_item_index()
    {
        // Create and authenticate a user
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create some items
        Item::factory()->count(5)->create();

        // Test the index route
        $response = $this->get(route('items.index'));

        $response->assertStatus(200);
        $response->assertViewIs('items.index');
    }

    public function test_item_store()
    {
        // Create and authenticate a user
        $user = User::factory()->create();
        $this->actingAs($user);

        // Test storing a new item
        $response = $this->post(route('items.store'), [
            'name' => 'Test Item',
            'price' => 100.00,
            'quantity' => 5,
        ]);

        $response->assertRedirect(route('items.index'));
        $this->assertDatabaseHas('items', ['name' => 'Test Item']);
    }

    public function test_item_update()
    {
        // Create and authenticate a user
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create an item to update
        $item = Item::factory()->create();

        // Test updating the item
        $response = $this->put(route('items.update', $item), [
            'name' => 'Updated Item',
            'price' => 150.00,
            'quantity' => 10,
        ]);

        $response->assertRedirect(route('items.index'));
        $this->assertDatabaseHas('items', ['name' => 'Updated Item']);
    }

    public function test_item_delete()
    {
        // Create and authenticate a user
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create an item to delete
        $item = Item::factory()->create();

        // Test deleting the item
        $response = $this->delete(route('items.destroy', $item));

        $response->assertRedirect(route('items.index'));
        $this->assertDatabaseMissing('items', ['id' => $item->id]);
    }
}
