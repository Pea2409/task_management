<?php

namespace Tests\Feature\Tasks;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DeleteTaskTest extends TestCase
{
    #[Test]
    public function authenticated_user_can_deleted_task(): void
    {
        $task = Task::factory()->create();
        $response = $this->actingAs($this->getUserId())
            ->delete($this->getRouteDeleteTask($task));
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
        $response->assertStatus(200);
    }

    #[Test]
    public function authenticated_user_can_not_deleted_task(): void
    {
        $task = Task::factory()->create();
        $response = $this->delete($this->getRouteDeleteTask($task));
        $response->assertRedirect('/login');
    }

    public function getRouteViewTask()
    {
        return route('tasks.index');
    }

    public function getRouteDeleteTask(Task $task)
    {
        return route('tasks.destroy', $task);
    }

    public function getUserId()
    {
        return User::find(1);
    }
}
