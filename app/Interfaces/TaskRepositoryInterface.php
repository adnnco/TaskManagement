<?php

namespace App\Interfaces;

/**
 * Interface TaskRepositoryInterface
 *
 * This interface defines the methods required for task repository operations.
 */
interface TaskRepositoryInterface
{
    /**
     * Retrieve a task by its ID.
     *
     * @param int $id The ID of the task to retrieve.
     * @return mixed
     */
    public function getById(int $id): mixed;

    /**
     * Retrieve all tasks with optional pagination.
     *
     * @param int $limit The number of tasks to retrieve per page.
     * @return mixed
     */
    public function index(int $limit = 10): mixed;

    /**
     * Store a new task.
     *
     * @param array $data The data of the task to be stored.
     * @return mixed
     */
    public function store(array $data): mixed;

    /**
     * Update an existing task.
     *
     * @param array $data The data to update the task with.
     * @param int $id The ID of the task to be updated.
     * @return mixed
     */
    public function update(array $data, int $id): mixed;

    /**
     * Delete a task.
     *
     * @param int $id The ID of the task to be deleted.
     * @return mixed
     */
    public function delete(int $id): mixed;
}
