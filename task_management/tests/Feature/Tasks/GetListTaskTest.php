<?php

namespace Tests\Feature\Tasks;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class GetListTaskTest extends TestCase
{
    public function getRouteTaskIndex()
    {
        return route('tasks.index');
    }
    #[Test]
    public function user_can_get_all_task(): void
    {
        $task = Task::factory()->create();
        $response = $this->get($this->getRouteTaskIndex());

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('tasks.index');
        $response->assertSee($task->name);
    }
}
