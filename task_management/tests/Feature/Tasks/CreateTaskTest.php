<?php

namespace Tests\Feature\Tasks;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CreateTaskTest extends TestCase
{
    #[Test]
    public function authenticated_user_can_new_task(): void
    {
        $task = Task::factory()->make()->toArray();
        $response = $this->actingAs($this->getUserId())
            ->post($this->getRouteCreateTask($task));

        $this->assertDatabaseHas('tasks', $task);
        $response->assertStatus(Response::HTTP_OK);
    }

    #[Test]
    public function user_cannot_new_task_if_not_authenticated(): void
    {
        $task = Task::factory()->make()->toArray();
        $response = $this->post($this->getRouteCreateTask($task));
        $response->assertRedirect('/login');
    }

    #[Test]
    public function authenticated_user_cannot_new_task_if_field_name_null(): void
    {
        $task = Task::factory()->make(['name' => null])->toArray();
        $response = $this->actingAs($this->getUserId())
            ->post($this->getRouteCreateTask($task));
        $response->assertSessionHasErrors(['name']);
    }

    #[Test]
    public function authenticated_user_cannot_new_task_if_field_content_null(): void
    {
        $task = Task::factory()->make(['content' => null])->toArray();
        $response = $this->actingAs($this->getUserId())
            ->post($this->getRouteCreateTask($task));
        $response->assertSessionHasErrors(['content']);
    }

    public function getRouteCreateTask($task)
    {
        return route('tasks.store', $task);
    }

    public function getUserId()
    {
        return User::find(1);
    }
}
