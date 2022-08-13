<?php


namespace App\Controllers;


use App\Models\Tasks;
use Core\Http\JsonResponse;
use Core\Http\Request;

class PaginationController
{
    private Tasks $tasks;

    /**
     * PaginationController constructor.
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
    public function getAllTasks(Request $request): JsonResponse
    {
        $getCountTask = $this->tasks->getAllUserByTask();
        return new JsonResponse([$getCountTask]);
    }

    /**
     * @param \Core\Http\Request $request
     * @return \Core\Http\JsonResponse
     */
    public function getPagination(Request $request): JsonResponse
    {
        $request1 = $request;
        $param = $request1->getPostParam();
        $limit = $param['page'];
        $limit = $limit * 3 - 3;
        $getTask = $this->tasks->getTask($limit, 3);
        $getTask['admin'] = $_SESSION['admin'];
        return new JsonResponse([$getTask]);
    }

    /**
     * @param \Core\Http\Request $request
     * @return \Core\Http\JsonResponse
     */
    public function getAllTasksEmails(Request $request): JsonResponse
    {
        $request1 = $request;
        $param = $request1->getPostParam();
        $emailId = $param['email'];
        $limit = $param['page'];
        $limit = $limit * 3 - 3;
        $getTask = $this->tasks->getTaskEmail($limit, 3, $emailId);
        $getTask['admin'] = $_SESSION['admin'];
        return new JsonResponse([$getTask]);
    }

    /**
     * @param \Core\Http\Request $request
     * @return \Core\Http\JsonResponse
     */
    public function getAllTasksUser(Request $request): JsonResponse
    {
        $request1 = $request;
        $param = $request1->getPostParam();
        $userId = $param['userId'];
        $limit = $param['page'];
        $limit = $limit * 3 - 3;
        $getTask = $this->tasks->getTaskUser($limit, 3, $userId);
        $getTask['admin'] = $_SESSION['admin'];
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

    /**
     * @param \Core\Http\Request $request
     * @return \Core\Http\JsonResponse
     */
    public function getPaginationStatusFinished(Request $request): JsonResponse
    {
        $request1 = $request;
        $param = $request1->getPostParam();
        $limit = $param['page'];
        $limit = $limit * 3 - 3;
        $statusFinishedCount = $this->tasks->getAllStatusFinishedByTask();
        $statusFinishedCount = $statusFinishedCount[0];
        $getTask = $this->tasks->getTaskStatusFinishedPag($limit, 3);
        $getTask['admin'] = $_SESSION['admin'];
        $getTask['count'] = $statusFinishedCount[0];
        return new JsonResponse([$getTask]);
    }

    /**
     * @param \Core\Http\Request $request
     * @return \Core\Http\JsonResponse
     */
    public function getPaginationStatusNonFinished(Request $request): JsonResponse
    {
        $request1 = $request;
        $param = $request1->getPostParam();
        $limit = $param['page'];
        $limit = $limit * 3 - 3;
        $statusNonFinishedCount = $this->tasks->getAllStatusNonFinishedByTask();
        $statusNonFinishedCount = $statusNonFinishedCount[0];
        $getTask = $this->tasks->getTaskStatusNonFinishedPag($limit, 3);
        $getTask['admin'] = $_SESSION['admin'];
        $getTask['count'] = $statusNonFinishedCount[0];
        return new JsonResponse([$getTask]);
    }

    /**
     * @param \Core\Http\Request $request
     * @return \Core\Http\JsonResponse
     */
    public function getPaginationEmail(Request $request): JsonResponse
    {
        $request1 = $request;
        $param = $request1->getPostParam();
        $email = $param['email'];
        $limit = $param['page'];
        $limit = $limit * 3 - 3;
        $emailId = $this->tasks->getEmailIdByEmails($email);
        $emailId = $emailId[0];
        $emailId = $emailId['email_id'];
        $emailCount = $this->tasks->getAllEmailCountByTask($emailId);
        $emailCount = $emailCount[0];
        $getTask = $this->tasks->getTaskEmailPag($limit, 3, $emailId);
        $getTask['admin'] = $_SESSION['admin'];
        $getTask['count'] = $emailCount[0];
        return new JsonResponse([$getTask]);
    }

    /**
     * @param \Core\Http\Request $request
     * @return \Core\Http\JsonResponse
     */
    public function getPaginationTaskComplete(Request $request): JsonResponse
    {
        $request1 = $request;
        $param = $request1->getPostParam();
        $limit = $param['page'];
//        return new JsonResponse([$limit]);
        $limit = $limit * 3 - 3;
        $completeTaskCount = $this->tasks->getAllTaskCompleteCountByTask();
        $getTask = $this->tasks->getCompleteTaskPag($limit, 3);
        $getTask['admin'] = $_SESSION['admin'];
        $getTask['count'] = $completeTaskCount[0];
        return new JsonResponse([$getTask]);
    }

    /**
     * @param \Core\Http\Request $request
     * @return \Core\Http\JsonResponse
     */
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