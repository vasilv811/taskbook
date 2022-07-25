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
        if (!array_key_exists('admin', $_SESSION)){
            $_SESSION['admin'] = false;
        }
        $getCountTask['admin'] = $_SESSION['admin'];
        return new JsonResponse([$getCountTask]);
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
//        $getTask['admin'] = $_SESSION['admin'];
//        if ($_SESSION['admin'] === false){
//            $session = ['admin' => false];
//        }else{
//            $session = ['admin' => true];
//        }
//        $getTask[] = ['admin' => false];
        return new JsonResponse([$getTask]);
    }
}