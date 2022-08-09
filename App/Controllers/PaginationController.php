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
        $getCountTask = $this->tasks->getAllUserByTask();
//        if (!array_key_exists('admin', $_SESSION)){
//            $_SESSION['admin'] = false;
//        }
//        $getCountTask['admin'] = $_SESSION['admin'];
        return new JsonResponse([$getCountTask]);
    }

    public function getStartPaginationUsers(Request $request): JsonResponse
    {
        $getCountTask = $this->tasks->getAllTasksByTask();
//        if (!array_key_exists('admin', $_SESSION)){
//            $_SESSION['admin'] = false;
//        }
//        $getCountTask['admin'] = $_SESSION['admin'];
        return new JsonResponse([$getCountTask]);
    }

    public function getPagination(Request $request): JsonResponse
    {
//        $ggg = ['hi'];
        $request1 = $request;
        $param = $request1->getPostParam();
        $limit = $param['page'];
        $limit = $limit * 3 - 3;
//        $count = $this->tasks->getAllTasksByTask();
//        $count = $count[0];
        $getTask = $this->tasks->getTask($limit, 3);
        $getTask['admin'] = $_SESSION['admin'];
//        if ($_SESSION['admin'] === false){
//            $session = ['admin' => false];
//        }else{
//            $session = ['admin' => true];
//        }
//        $getTask[] = ['admin' => false];
        return new JsonResponse([$getTask]);
    }

    /**
     * @param \Core\Http\Request $request
     * @return \Core\Http\JsonResponse
     */
    public function getPaginationUsers(Request $request): JsonResponse
    {
        $request1 = $request;
        $param = $request1->getPostParam();
        $user = $param['user'];
        $limit = $param['page'];
        $limit = $limit * 3 - 3;
        $nameId = $this->tasks->getNameIdByName($user);
        $nameId = $nameId[0];
        $nameId = $nameId['name_id'];
        $userCount = $this->tasks->getAllUserCountByTask($nameId);
        $userCount = $userCount[0];
        $getTask = $this->tasks->getTaskUserPag($limit, 3, $nameId);
        $getTask['admin'] = $_SESSION['admin'];
        $getTask['count'] = $userCount[0];
        return new JsonResponse([$getTask]);
    }

    public function getPaginationEmail(Request $request): JsonResponse
    {
        $request1 = $request;
        $param = $request1->getPostParam();
        $email = $param['email'];
        $limit = $param['page'];
        $limit = $limit * 3 - 3;
        $emailId = $this->tasks->getEmailIdByEmails($email);
//        return new JsonResponse([$emailId]);
        $emailId = $emailId[0];
        $emailId = $emailId['email_id'];
//                return new JsonResponse([$emailId]);

        $emailCount = $this->tasks->getAllEmailCountByTask($emailId);
//                        return new JsonResponse([$emailCount]);

        $emailCount = $emailCount[0];
        $getTask = $this->tasks->getTaskEmailPag($limit, 3, $emailId);
        $getTask['admin'] = $_SESSION['admin'];
        $getTask['count'] = $emailCount[0];
        return new JsonResponse([$getTask]);
    }

    public function getPaginationTaskComplete(Request $request): JsonResponse
    {
        $request1 = $request;
        $param = $request1->getPostParam();
        $limit = $param['page'];
        $limit = $limit * 3 - 3;
        $completeTaskCount = $this->tasks->getAllTaskCompleteCountByTask();
        $getTask = $this->tasks->getCompleteTaskPag($limit, 3);
        $getTask['admin'] = $_SESSION['admin'];
        $getTask['count'] = $completeTaskCount[0];
        return new JsonResponse([$getTask]);
    }

    public function getPaginationTaskNotComplete(Request $request): JsonResponse
    {
        $request1 = $request;
        $param = $request1->getPostParam();
        $limit = $param['page'];
        $limit = $limit * 3 - 3;
        $notCompleteTaskCount = $this->tasks->getAllTaskNotCompleteCountByTask();
        $getTask = $this->tasks->getNotCompleteTaskPag($limit, 3);
        $getTask['admin'] = $_SESSION['admin'];
        $getTask['count'] = $notCompleteTaskCount[0];
        return new JsonResponse([$getTask]);
    }

}