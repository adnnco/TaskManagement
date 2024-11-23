<?php

namespace App\Repositories;

use App\Interfaces\TaskRepositoryInterface;
use App\Models\Task;

class TaskRepository implements TaskRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function index(int $limit): mixed
    {
        return Task::paginate($limit);
    }

    /**
     * @inheritDoc
     */
    public function store(array $data): mixed
    {
        return Task::create($data);
    }

    /**
     * @inheritDoc
     */
    public function update(array $data, $id): mixed
    {
        $task = Task::findOrFail($id);
        $task->update($data);
        $task->save();

        return $this->getById($id);
    }

    /**
     * @inheritDoc
     */
    public function delete($id): mixed
    {
        return Task::destroy($id);
    }

    /**
     * @inheritDoc
     */
    public function getById(int $id): mixed
    {
        return Task::findOrFail($id);
    }
}
