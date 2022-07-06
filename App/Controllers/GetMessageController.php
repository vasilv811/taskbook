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

    public function __construct(Tasks $tasks)
    {
        $this->tasks = $tasks;
    }

    public function getMessage(Request $request): JsonResponse
    {
        $getMessage = $this->tasks->getAllByMessage();
//        $getName = $this->tasks->getNameByMessage();
//        $getEmail = $this->tasks->getEmailByMessage();
//        $getNameTask = $this->tasks->getNameTaskByMessage();
//        $getEmailTask = $this->tasks->getEmailTaskByMessage();
//        foreach ($getMessage as $k => $v) {
//            if ($k === $getName[''])
//        }

        return new JsonResponse($getMessage);
    }
}