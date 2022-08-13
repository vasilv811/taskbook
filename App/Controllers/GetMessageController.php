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
     * @return JsonResponse
     */
    public function getAllMessage(): JsonResponse
    {
        $getAllMessage = $this->tasks->getAllByMessage();
        return new JsonResponse($getAllMessage);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getMessageByTaskId(Request $request): JsonResponse
    {
        $id = $request->getPostParam();
        $id = $id['task_id'];
        $getMessageByTaskId = $this->tasks->getByMessageTaskId($id);
        return new JsonResponse($getMessageByTaskId);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getMessageBySortUser(Request $request): JsonResponse
    {
        $user = $request->getPostParam();
        $user = $user['user'];
        $userId = $this->tasks->getUserIdByUsers($user);
        $userId = $userId['name_id'];
        $tasksBySortUser = $this->tasks->getTasksByUserId($userId);
        return new JsonResponse($tasksBySortUser);
    }
}