<?php


namespace App\Controllers;


use App\Models\Admins;
use Core\Http\Request;
use Core\Http\JsonResponse;

class AdminController
{

    /**
     * @var Admins
     */
    private Admins $admins;

    /**
     * AdminController constructor.
     * @param Admins $admins
     */
    public function __construct(Admins $admins)
    {
        $this->admins = $admins;
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getAdmins(Request $request): JsonResponse
    {
        $post = $request->getPostParam();
        $login = (string)$post['login'];
        $password = $post['password'];
        $admins = $this->admins->getAdmins($login);
        $admins = !(($admins === null || !password_verify($password, $admins[0]['password'])));
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