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

/**
 * Class TaskController
 *
 * This controller handles task-related actions such as creating, updating, and deleting tasks.
 */
class TaskController extends Controller
{
    private TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * Display a listing of tasks.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return ApiResponseService::sendResponse(
            TaskResource::collection($this->taskRepository->index(15))
        );
    }

    /**
     * Store a newly created task.
     *
     * @param TaskCreateRequest $request
     * @return JsonResponse|void
     */
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

    /**
     * Display the specified task.
     *
     * @param int $id
     * @return JsonResponse|void
     */
    public function show(int $id)
    {
        try {
            $task = $this->taskRepository->getById($id);

            return ApiResponseService::sendResponse(new TaskResource($task));
        } catch (Exception $e) {
            ApiResponseService::rollback($e, 'Task not found');
        }
    }

    /**
     * Update the specified task.
     *
     * @param TaskUpdateRequest $request
     * @param int $id
     * @return JsonResponse|void
     */
    public function update(TaskUpdateRequest $request, int $id)
    {
        $validated = $request->validated();

        try {
            $task = $this->taskRepository->update($validated, $id);

            return ApiResponseService::sendResponse(new TaskResource($task), 'Task updated successfully');
        } catch (Exception $e) {
            ApiResponseService::rollback($e, 'Task update failed');
        }
    }

    /**
     * Remove the specified task.
     *
     * @param int $id
     * @return JsonResponse|void
     */
    public function destroy(int $id)
    {
        try {
            $this->taskRepository->delete($id);

            return ApiResponseService::sendResponse([], 'Task deleted successfully');
        } catch (Exception $e) {
            ApiResponseService::rollback($e, 'Task deletion failed');
        }
    }
}
