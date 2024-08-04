<?php

namespace App\Repositories;

use App\Interfaces\TaskRepositoriesInterface;
use App\Models\Task;

class TaskRepository implements TaskRepositoriesInterface
{
    private Task $task;

    protected $perPage = 6;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }
    public function getAllTasks($search, $perPage = null)
    {
        $perPage = $perPage ?? $this->perPage;
        if ($search) {
            return $this->task->where('name', 'like', '%' . $search . '%')
                ->latest('id')
                ->paginate($perPage);
        }
        return $this->task->latest('id')->paginate($perPage);
    }
    public function createTask(array $data)
    {
        return $this->task->create([
            'name' => $data['name'],
            'content' => $data['content'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
