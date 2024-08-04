<?php

namespace App\Interfaces;

interface TaskRepositoriesInterface
{
    public function getAllTasks($search, $perPage);
    public function createTask(array $data);
}
