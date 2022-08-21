<?php


namespace App\Controllers;


use App\Models\Tasks;
use Core\Http\JsonResponse;
use Core\Http\Request;

class PaginationController
{

    /**
     * @var Tasks
     */
    private Tasks $tasks;


    /**
     * PaginationController constructor.
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
    public function getPagination(Request $request): JsonResponse
    {
        $param = $request->getPostParam();
        $currentTask = $param['page'] * 3 - 3;
        $filter = (empty($param['filter'])) ? null : $param['filter'];
        $emailAddress = (empty($param['emailAddress'])) ? null : $param['emailAddress'];
        $name = (empty($param['name'])) ? null : $param['name'];
        $filterUserEmail = '';
        if ($emailAddress !== null && $name === null) {
            $filterUserEmail = 'email';
        }
        if ($emailAddress === null && $name !== null) {
            $filterUserEmail = 'user';
        }
        $pageTaskPaginating = $this->tasks->getPagePaginating($currentTask, $filter, $emailAddress, $name);
        $pageTaskPaginating['admin'] = $_SESSION['admin'];
        $pageTaskPaginating['filterUserEmail'] = $filterUserEmail;
        return new JsonResponse([$pageTaskPaginating]);
    }
}