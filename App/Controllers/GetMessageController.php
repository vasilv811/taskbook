<?php


namespace App\Controllers;


use App\Models\Tasks;
use Core\Http\JsonResponse;
use Core\Http\Request;

class GetMessageController
{

    /**
     * @var \App\Models\Tasks
     */
    private Tasks $tasks;

    /**
     * GetMessageController constructor.
     * @param \App\Models\Tasks $tasks
     */
    public function __construct(Tasks $tasks)
    {
        $this->tasks = $tasks;
    }

    /**
     * @param \Core\Http\Request $request
     * @return \Core\Http\JsonResponse
     */
    public function getAllMessage(Request $request): JsonResponse
    {
        $getAllMessage = $this->tasks->getAllByMessage();
        return new JsonResponse($getAllMessage);
    }

    public function getMessageByTaskId(Request $request)
    {
        $id = $request->getPostParam();
        $id = $id['task_id'];
        $getMessageByTaskId = $this->tasks->getByMessageTaskId($id);
        return new JsonResponse($getMessageByTaskId);
    }
}