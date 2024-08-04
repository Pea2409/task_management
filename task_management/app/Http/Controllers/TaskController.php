<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
    public function create()
    {
        return response()->json([''], Response::HTTP_OK);
    }

    public function store(CreateTaskRequest $request)
    {
        $this->taskService->createTask($request->all());
        alert()->success('Task created successfully');
        return response()->json([''], Response::HTTP_OK);
    }
    public function edit(Task $task)
    {
        return response()->json([$task], Response::HTTP_OK);
    }


    public function update(UpdateTaskRequest $request, Task $task)
    {
        $this->taskService->updateTask($request->all(), $task->id);
        alert()->success('Task updated successfully');
        return response()->json([$task], Response::HTTP_OK);
    }
    public function destroy(Task $task)
    {
        $this->taskService->deleteTask($task->id);
        alert()->success('Task deleted successfully');
        return response()->json([$task], Response::HTTP_OK);
    }
}
