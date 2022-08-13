<?php


namespace App\Controllers;


use App\Models\Tasks;
use Core\Http\Request;
use Core\Http\JsonResponse;

class AdminController
{

    /**
     * @var Tasks
     */
    private Tasks $tasks;


    /**
     * AdminController constructor.
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
    public function getAdminCheck(Request $request): JsonResponse
    {
        $admin = '';
        $post = $request->getPostParam();
        $validAdmin = $this->tasks->getAdminCheck();
        foreach ($validAdmin as $item) {
            if ($item['login'] === $post['login'] && $item['password'] === $post['password']) {
                $admin = true;
            } else {
                $admin = false;
            }
        }
        $_SESSION['admin'] = $admin;
        return new JsonResponse($_SESSION);
    }


    /**
     * @return JsonResponse
     */
    public function getStatusAdmin(): JsonResponse
    {
        if (!array_key_exists('admin', $_SESSION)) {
            $_SESSION['admin'] = false;
        }
        $getStatusAdmin['admin'] = $_SESSION['admin'];
        return new JsonResponse($getStatusAdmin);
    }

    /**
     * @return JsonResponse
     */
    public function getAdminOutput(): JsonResponse
    {
        $_SESSION['admin'] = false;
        return new JsonResponse($_SESSION);
    }

    /**
     * @return JsonResponse
     */
    public function getRequestAdmin(): JsonResponse
    {
        return new JsonResponse([$_SESSION]);
    }
}