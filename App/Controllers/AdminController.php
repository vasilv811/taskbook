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
    public function getAdmins(Request $request): JsonResponse
    {
        $post = $request->getPostParam();
        $login = (string)$post['login'];
        $password = md5(md5($post['password'] . '@$%fdep35'));
        $admins = $this->tasks->getAdmins($login, $password);
        $success = ['success' => ($admins === true) ? 'Вы вошли как администратор' : 'Вы ввели неверный логин или пароль'];
        if (!$_SESSION['admin']) {
            $_SESSION['admin'] = $admins;
        }
        return new JsonResponse($success);
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
        return new JsonResponse(['success' => 'Вы вышли из аккаунта администратора']);
    }
}