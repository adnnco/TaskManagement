<?php

namespace App\Repositories;

use App\Interfaces\TaskRepositoryInterface;
use App\Models\Task;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TaskRepository implements TaskRepositoryInterface
{
    /**
     * Retrieve all tasks with optional pagination.
     *
     * @param int $limit The number of tasks to retrieve per page.
     * @return mixed
     */
    public function index(int $limit = 10): mixed
    {
        return Task::paginate($limit);
    }

    /**
     * Store a new task.
     *
     * @param array $data The data of the task to be stored.
     * @return mixed
     */
    public function store(array $data): mixed
    {
        return Task::create($data);
    }

    /**
     * Update an existing task.
     *
     * @param array $data The data to update the task with.
     * @param int $id The ID of the task to be updated.
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function update(array $data, int $id): mixed
    {
        $task = Task::findOrFail($id);
        $task->update($data);

        return $task;
    }

    /**
     * Delete a task.
     *
     * @param int $id The ID of the task to be deleted.
     * @return bool|null
     * @throws ModelNotFoundException
     */
    public function delete(int $id): ?bool
    {
        $task = Task::findOrFail($id);
        return $task->delete();
    }

    /**
     * Retrieve a task by its ID.
     *
     * @param int $id The ID of the task to retrieve.
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function getById(int $id): mixed
    {
        return Task::findOrFail($id);
    }
}
