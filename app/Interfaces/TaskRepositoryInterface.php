<?php

namespace App\Interfaces;

/**
 * Interface TaskRepositoryInterface
 *
 * This interface defines the methods required for task repository operations.
 */
interface TaskRepositoryInterface
{

    public function getById(int $id): mixed;

    /**
     * Retrieve all tasks.
     *
     * @return mixed
     */
    public function index(int $limit): mixed;

    /**
     * Store a new task.
     *
     * @param  array  $data  The data of the task to be stored.
     * @return mixed
     */
    public function store(array $data): mixed;

    /**
     * Update an existing task.
     *
     * @param  array  $data  The data to update the task with.
     * @param  int  $id  The ID of the task to be updated.
     * @return mixed
     */
    public function update(array $data, $id): mixed;

    /**
     * Delete a task.
     *
     * @param  int  $id  The ID of the task to be deleted.
     * @return mixed
     */
    public function delete($id): mixed;
}
