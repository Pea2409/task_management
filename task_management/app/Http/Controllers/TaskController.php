<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }
    public function index(Request $request)
    {
        $search = $request->search;
        $request->flashOnly('search');
        $tasks = $this->taskService->getAllTasks($search);
        return view('tasks.index', compact('tasks', 'search'));
    }
}
