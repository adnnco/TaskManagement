<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TaskCreateRequest;
use App\Http\Requests\Api\TaskUpdateRequest;
use App\Http\Resources\Api\TaskResource;
use App\Repositories\TaskRepository;
use App\Services\ApiResponseService;
use Exception;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    public TaskRepository $taskRepository;

    /**
     * TaskController constructor.
     */
    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function index()
    {
        return ApiResponseService::sendResponse(
            TaskResource::collection($this->taskRepository->index(15)), '', 200
        );
    }

    public function store(TaskCreateRequest $request)
    {
        $validated = $request->validated();

        try {
            $task = $this->taskRepository->store($validated);

            return ApiResponseService::sendResponse(new TaskResource($task), 'Task created successfully', 201);
        } catch (Exception $e) {
            ApiResponseService::rollback($e, 'Task creation failed');
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            $task = $this->taskRepository->getById($id);

            return ApiResponseService::sendResponse(new TaskResource($task));
        } catch (Exception $e) {
            ApiResponseService::rollback($e, 'Task not found');
        }
    }

    public function update(TaskUpdateRequest $request, int $id): JsonResponse
    {
        $validated = $request->validated();

        try {
            $task = $this->taskRepository->update($validated, $id);

            return ApiResponseService::sendResponse(new TaskResource($task), 'Task updated successfully', 200);
        } catch (Exception $e) {
            return ApiResponseService::rollback($e, 'Task update failed');
        }
    }

    public function destroy($id)
    {
        try {
            $this->taskRepository->delete($id);

            return ApiResponseService::sendResponse([], 'Task deleted successfully', 200);
        } catch (Exception $e) {
            return ApiResponseService::rollback($e, 'Task deletion failed');
        }
    }
}
