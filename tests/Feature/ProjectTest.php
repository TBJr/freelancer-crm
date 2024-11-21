<?php
namespace Tests\Feature;

use App\Models\Project;
use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    public function test_project_index()
    {
        Project::factory()->count(5)->create();

        $response = $this->get(route('projects.index'));

        $response->assertStatus(200);
        $response->assertViewIs('projects.index');
    }

    public function test_project_store()
    {
        $customer = Customer::factory()->create();

        $response = $this->post(route('projects.store'), [
            'name' => 'Project 1',
            'customer_id' => $customer->id,
            'start_date' => now()->toDateString(),
            'end_date' => now()->addDays(30)->toDateString(),
            'description' => 'Test project description',
        ]);

        $response->assertRedirect(route('projects.index'));
        $this->assertDatabaseHas('projects', ['name' => 'Project 1']);
    }

    public function test_project_update()
    {
        $project = Project::factory()->create();

        $response = $this->put(route('projects.update', $project), [
            'name' => 'Updated Project',
            'description' => 'Updated description',
            'start_date' => $project->start_date, // Use the existing start_date
            'end_date' => $project->start_date->copy()->addDays(1), // Ensure end_date is after start_date
            'customer_id' => $project->customer_id, // Include required customer_id
        ]);

        $response->assertRedirect(route('projects.index'));
        $this->assertDatabaseHas('projects', ['name' => 'Updated Project']);
    }

    public function test_project_delete()
    {
        $project = Project::factory()->create();

        $response = $this->delete(route('projects.destroy', $project));

        $response->assertRedirect(route('projects.index'));
        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    }
}
