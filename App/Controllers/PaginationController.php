<?php


namespace App\Controllers;


use App\Models\Tasks;
use Core\Http\JsonResponse;
use Core\Http\Request;

class PaginationController
{
    private Tasks $tasks;

    public function __construct(Tasks $tasks)
    {
        $this->tasks = $tasks;
    }

    public function getAllTasks(Request $request): JsonResponse
    {
        $getCountTask = $this->tasks->getAllTasksByTask();
        return new JsonResponse($getCountTask);
    }

    public function getPagination(Request $request): JsonResponse
    {
//        $ggg = ['hi'];
        $request1 = $request;
        $param = $request1->getPostParam();
        $limit = $param['page'];
        $limit = $limit * 3 - 3;
        $count = $this->tasks->getAllTasksByTask();
//        $count = $count[0];
        $getTask = $this->tasks->getTask($limit, 3);
        return new JsonResponse($getTask);
    }
}