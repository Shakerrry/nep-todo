<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Response;
use \Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    /**
     * Retreieve all tasks
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {

        $tasks = Task::orderBy('completed', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        return Response::json([
            'success' => true,
            'tasks' => $tasks
        ], 200);
    }

    /**
     * Store a new task
     *
     * @param StoreTaskRequest $request
     * @return JsonResponse
     */
    public function store(StoreTaskRequest $request): JsonResponse
    {
        $task = Task::create($request->validated());

        $task = $task->fresh();

        return Response::json([
            'success' => true,
            'task' => $task
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {

        try {
            $task = Task::findOrfail($id);
        } catch (ModelNotFoundException $e) {

            return Response::json([
                'success' => false,
                'message' => 'Task has not been found!'
            ], 404);
        }

        return Response::json([
            'success' => true,
            'task' => $task
        ], 200);
    }

    /**
     * Update the specified task
     *
     * @param UpdateTaskRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateTaskRequest $request, int $id): JsonResponse
    {
        try {
            $task = Task::findOrfail($id);
        } catch (ModelNotFoundException $e) {

            return Response::json([
                'success' => false,
                'message' => 'Task has not been found!'
            ], 404);
        }

        $task->update($request->validated());

        return Response::json([
            'success' => true,
            'task' => $task
        ], 200);
    }

    /**
     * Remove the specified task
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $task = Task::findOrfail($id);
        } catch (ModelNotFoundException $e) {

            return Response::json([
                'success' => false,
                'message' => 'Task has not been found!'
            ], 404);
        }

        $task->delete();

        return Response::json([
            'success' => true,
            'message' => 'Task has beed deleted successfully!'
        ], 200);
    }
}
