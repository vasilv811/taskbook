<?php


namespace App\Controllers;


use App\Models\Tasks;
use Core\Http\Request;
use Core\Http\JsonResponse;

class AdminController
{
    /**
     * @var \App\Models\Tasks
     */
    private Tasks $tasks;

    public function __construct(Tasks $tasks)
    {
        $this->tasks = $tasks;
    }

    /**
     * @param \Core\Http\Request $request
     * @return \Core\Http\JsonResponse
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
     * @param \Core\Http\Request $request
     * @return \Core\Http\JsonResponse
     */
    public function getStatusAdmin(Request $request): JsonResponse
    {
        if (!array_key_exists('admin', $_SESSION)) {
            $_SESSION['admin'] = false;
        }
        $getStatusAdmin['admin'] = $_SESSION['admin'];
        return new JsonResponse($getStatusAdmin);
    }

    /**
     * @return \Core\Http\JsonResponse
     */
    public function getAdminOutput(): JsonResponse
    {
        $_SESSION['admin'] = false;
        return new JsonResponse($_SESSION);
    }

    /**
     * @return \Core\Http\JsonResponse
     */
    public function getRequestAdmin(): JsonResponse
    {
        return new JsonResponse([$_SESSION]);
    }
}
