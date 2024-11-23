<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['title' => 'required|string|max:255', 'description' => 'nullable|string', 'status' => 'required|in:pending,completed']);

        $task = Task::create($request->all());

        return response()->json($task, 201);
    }

    public function index()
    {
        $tasks = Task::paginate(10);

        return response()->json($tasks);
    }

    public function update(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:pending,completed']);

        $task = Task::findOrFail($id);
        $task->update($request->only('status'));

        return response()->json($task);
    }

    public function delete($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return response()->json(null, 204);
    }
}
