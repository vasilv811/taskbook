<?php


namespace App\Controllers;


use App\Models\Tasks;
use Core\Http\JsonResponse;
use Core\Http\Request;

class GetNameController
{

    /**
     * @var \App\Models\Tasks
     */
    private Tasks $tasks;

    public function __construct(Tasks $tasks)
    {
        $this->tasks = $tasks;
    }

    public function getName(Request $request): JsonResponse
    {
        $getName = $this->tasks->getNameByMessage();
//        $getName = $this->tasks->getNameByMessage();
//        $getEmail = $this->tasks->getEmailByMessage();
//        $getNameTask = $this->tasks->getNameTaskByMessage();
//        $getEmailTask = $this->tasks->getEmailTaskByMessage();
//        foreach ($getMessage as $k => $v){
//
//        }

        return new JsonResponse($getName);
    }
}