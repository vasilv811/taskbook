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

public function getAdminCheck(Request $request){
        $admin = '';
        $post = $request->getPostParam();
        $validAdmin = $this->tasks->getAdminCheck();
        foreach ($validAdmin as $item)
        if ($item['login'] === $post['login'] && $item['password'] === $post['password']){
            $admin = true;
        }else{
            $admin = false;
        }
        $_SESSION['admin'] = $admin;
        return new JsonResponse($_SESSION);
}

public function getAdminOutput(){
        $_SESSION['admin'] = false;
        return new JsonResponse($_SESSION);
}

public function getRequestAdmin(){
        return new JsonResponse([$_SESSION]);
}
}