<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TasksTest extends TestCase
{
    use RefreshDatabase;

    public function test_task_can_be_created()
    {
        $response = $this->post('/api/tasks', [
            'name' => 'test',
            'description' => 'Test',
        ]);

        $response->assertStatus(200);
    }

    public function test_tasks_can_be_retreieved()
    {
        Task::factory()->createOne();

        $task = Task::first();
        $response = $this->get('/api/tasks');

        $response->assertStatus(200);
        $this->assertSame($response['tasks'][0], $task->toArray());
    }

    public function test_tasks_can_be_deleted()
    {
        Task::factory()->count(10)->create();
        $task = Task::first();

        $response = $this->delete('/api/tasks/' . $task->id);

        $response->assertStatus(200);

        $taskCount = Task::all()->count();
        $this->assertEquals($taskCount, 9);
    }

    public function test_task_can_be_retrieved()
    {
        Task::factory()->createOne();

        $task = Task::first();
        $response = $this->get('/api/tasks/' . $task->id);

        $response->assertStatus(200);
        $this->assertSame($response['task'], $task->toArray());
    }
}
