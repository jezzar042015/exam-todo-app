<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function index()
    {
        // Return all tasks as resources
        return TaskResource::collection(Task::all());
    }

    public function store(TaskRequest $request)
    {
        // Create a new task and return it as a resource
        $task = Task::create($request->validated());
        return new TaskResource($task);
    }

    public function show(Task $task)
    {
        // Return a single task as a resource
        return new TaskResource($task);
    }

    public function update(TaskRequest $request, Task $task)
    {
        // Update a task and return the updated task as a resource
        $task->update($request->validated());
        return new TaskResource($task);
    }

    public function destroy(Task $task)
    {
        // Delete the task
        $task->delete();
        return response()->json(['message' => 'Task deleted successfully'], 200);
    }
}
