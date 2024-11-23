<?php

use App\Models\Task;
use App\Models\User;
use App\Repositories\TaskRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user, 'api');
    $this->taskRepository = app(TaskRepository::class);
});

it('can create a task', function () {
    $taskData = [
        'title' => 'Test Task',
        'description' => 'Test Description',
        'status' => 'pending',
    ];

    $task = $this->taskRepository->store($taskData);

    $this->assertDatabaseHas('tasks', $taskData);
});

it('can update a task', function () {
    $task = Task::factory()->create();

    $updateData = [
        'title' => 'Updated Task',
        'description' => 'Updated Description',
        'status' => 'completed',
    ];

    $this->taskRepository->update($updateData, $task->id);

    $this->assertDatabaseHas('tasks', $updateData);
});

it('can delete a task', function () {
    $task = Task::factory()->create();

    $this->taskRepository->delete($task->id);

    $this->assertDatabaseHas('tasks', [
        'id' => $task->id,
        'deleted_at' => now(),
    ]);
});

it('can retrieve tasks', function () {
    Task::factory()->count(3)->create();

    $tasks = $this->taskRepository->index();

    expect($tasks->total())->toBe(3);
});

it('can retrieve a single task by id', function () {
    $task = Task::factory()->create();

    $retrievedTask = $this->taskRepository->getById($task->id);

    expect($retrievedTask->id)->toBe($task->id);
});
