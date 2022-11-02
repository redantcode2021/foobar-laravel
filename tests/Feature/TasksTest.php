<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use LaravelJsonApi\Testing\MakesJsonApiRequests;
use Illuminate\Foundation\Testing\RefreshDatabase;


class TasksTest extends TestCase
{
    // trait coming from 'laravel-json-api\testing
    use MakesJsonApiRequests;

    // we'll need this for all our tests
    protected $baseUrl = "api/v1/tasks";

    protected function setUp(): void
    {
        parent::setUp();

        // login with a randomly created user
        $this->actingAs(User::factory()->create());
    }
    public function test_read_all_tasks()
    {
        $model = Task::factory()->count(2)->create();

        $response = $this->jsonApi()
            ->expects("tasks")
            ->get($this->baseUrl);

        $response->assertStatus(200);
        $response->assertFetchedMany($model);
    }
}
