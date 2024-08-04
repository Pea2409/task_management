<?php

namespace Tests\Feature\Tasks;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UpdateTaskTest extends TestCase
{
    #[Test]
    public function authenticated_user_can_updated_task(): void
    {
        $task = Task::factory()->create();
        $updatedTaskData = Task::factory()->make()->toArray();
        $response = $this->actingAs($this->getUserId())
            ->put($this->getRouteUpdateTask($task), $updatedTaskData);
        $this->assertDatabaseHas('tasks', $updatedTaskData);
        $response->assertStatus(200);
    }

    #[Test]
    public function user_can_not_updated_task_if_not_authenticated(): void
    {
        $task = Task::factory()->create();
        $updatedTaskData = Task::factory()->make()->toArray();
        $response = $this->put($this->getRouteUpdateTask($task), $updatedTaskData);
        $response->assertRedirect('/login');
    }

    #[Test]
    public function authenticated_user_can_not_updated_task_if_name_feild_is_null()
    {
        $task = Task::factory()->create();
        $data = ['name' => null];
        $response = $this->actingAs($this->getUserId())
            ->put($this->getRouteUpdateTask($task), $data);
        $response->assertSessionHasErrors(['name']);
    }
    #[Test]
    public function authenticated_user_can_not_updated_task_if_content_feild_is_null()
    {
        $task = Task::factory()->create();
        $data = ['content' => null];
        $response = $this->actingAs($this->getUserId())
            ->put($this->getRouteUpdateTask($task), $data);
        $response->assertSessionHasErrors(['content']);
    }

    #[Test]
    public function authenticated_user_can_view_updated_task_form()
    {
        $task = Task::factory()->create();
        $response = $this->actingAs($this->getUserId())
            ->get($this->getRouteEditTask($task));
        $response->assertStatus(200);
    }

    #[Test]
    public function authenticated_user_can_see_name_required_text_if_validate_error()
    {
        $task = Task::factory()->create();
        $data = ['name' => null];
        $response = $this->actingAs($this->getUserId())
            ->from($this->getRouteEditTask($task))
            ->put($this->getRouteUpdateTask($task), $data);
        $response->assertRedirect($this->getRouteEditTask($task));
    }

    public function getRouteEditTask(Task $task)
    {
        return route('tasks.edit', $task);
    }

    public function getRouteUpdateTask(Task $task)
    {
        return route('tasks.update', $task);
    }

    public function getRouteViewIndex()
    {
        return route('tasks.index');
    }

    public function getUserId()
    {
        return User::find(1);
    }
}
