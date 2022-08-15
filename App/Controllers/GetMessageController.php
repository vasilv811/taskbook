<?php


namespace App\Controllers;


use App\Models\Tasks;
use Core\Http\JsonResponse;
use Core\Http\Request;

class GetMessageController
{

    /**
     * @var Tasks
     */
    private Tasks $tasks;

    /**
     * GetMessageController constructor.
     * @param Tasks $tasks
     */
    public function __construct(Tasks $tasks)
    {
        $this->tasks = $tasks;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getMessageByTaskId(Request $request): JsonResponse
    {
        $post = $request->getPostParam();
        $id = $post['task_id'] ?? null;
        $getTasksByTasksId = $this->tasks->getTasksByTasksId($id);
        return new JsonResponse($getTasksByTasksId);
    }
}