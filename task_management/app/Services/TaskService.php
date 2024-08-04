<?php

namespace App\Services;

use App\Interfaces\TaskRepositoriesInterface;

class TaskService
{
    private $taskRepo;

    public function __construct(TaskRepositoriesInterface $taskRepo)
    {
        $this->taskRepo = $taskRepo;
    }
    public function getAllTasks($search, $perPage = null)
    {
        return $this->taskRepo->getAllTasks($search, $perPage);
    }
    public function createTask(array $data)
    {
        return $this->taskRepo->createTask($data);
    }
    public function updateTask(array $data, $taskId)
    {
        return $this->taskRepo->updateTask($data, $taskId);
    }
}
