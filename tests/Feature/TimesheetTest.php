<?php
namespace Tests\Feature;

use App\Models\Timesheet;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TimesheetTest extends TestCase
{
    use RefreshDatabase;

    public function test_timesheet_index()
    {
        Timesheet::factory()->count(5)->create();

        $response = $this->get(route('timesheets.index'));

        $response->assertStatus(200);
        $response->assertViewIs('timesheets.index');
    }

    public function test_timesheet_store()
    {
        $project = Project::factory()->create();
        $user = User::factory()->create();

        $response = $this->post(route('timesheets.store'), [
            'project_id' => $project->id,
            'user_id' => $user->id,
            'hours' => 8,
            'date' => now()->toDateString(),
        ]);

        $response->assertRedirect(route('timesheets.index'));
        $this->assertDatabaseHas('timesheets', ['hours' => 8]);
    }

    public function test_timesheet_update()
    {
        $timesheet = Timesheet::factory()->create();

        // Include required fields for validation
        $response = $this->put(route('timesheets.update', $timesheet), [
            'project_id' => $timesheet->project_id, // Use the existing project_id
            'user_id' => $timesheet->user_id,       // Use the existing user_id
            'hours' => 10,
            'date' => now()->toDateString(),
        ]);

        $response->assertRedirect(route('timesheets.index')); // Check for redirection
        $this->assertDatabaseHas('timesheets', ['hours' => 10]); // Verify database update
    }

    public function test_timesheet_delete()
    {
        $timesheet = Timesheet::factory()->create();

        $response = $this->delete(route('timesheets.destroy', $timesheet));

        $response->assertRedirect(route('timesheets.index'));
        $this->assertDatabaseMissing('timesheets', ['id' => $timesheet->id]);
    }
}
