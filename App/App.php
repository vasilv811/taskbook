<?php


namespace App;

use App\Controllers\AdminController;
use App\Controllers\GetMessageController;
use App\Controllers\PaginationController;
use App\Controllers\SetMessageController;
use App\Controllers\UpdateMessageController;
use Core\Http\Request;
use Core\Routing\Route;
use Core\Routing\Router;
use Core\Core;
use App\Controllers\IndexController;



class App
{
    private $router;
    private Core $core;

    public function __construct(Core $core)
    {
//        session_start();

        $mainRoute = new Route (
            Request::METHOD_GET,
            '/',
            [
                IndexController::class,
                'getMainPage'
            ]
        );

        $setMessage = new Route (
            Request::METHOD_POST,
            '/message/set',
            [
                SetMessageController::class,
                'setMessage',
            ]
        );

        $adminCheck = new Route(
            Request::METHOD_POST,
            '/admin/check',
            [
                AdminController::class,
                'getAdmins',
            ]
        );

        $adminOutput = new Route(
            Request::METHOD_POST,
            '/admin/output',
            [
                AdminController::class,
                'getAdminOutput',
            ]
        );

        $getMessageByTaskId = new Route(
            Request::METHOD_POST,
            '/mesagebytaskid/get',
            [
                GetMessageController::class,
                'getMessageByTaskId',
            ]
        );

        $adminStatus = new Route(
            Request::METHOD_POST,
            '/adminstatus/check',
            [
                AdminController::class,
                'getStatusAdmin',
            ]
        );
//        dump($adminStatus);

        $changeMessage = new Route(
            Request::METHOD_POST,
            '/chengemessage/set',
            [
                UpdateMessageController::class,
                'changeMessage',
            ]
        );

        $pagination = new Route(
            Request::METHOD_POST,
            '/paginations/get',
            [
                PaginationController::class,
                'getPagination',
            ]
        );

        $this->router = $router = new Router();
        $router->addRoute($mainRoute);
        $router->addRoute($setMessage);
        $router->addRoute($adminCheck);
        $router->addRoute($adminOutput);
        $router->addRoute($getMessageByTaskId);
        $router->addRoute($adminStatus);
        $router->addRoute($changeMessage);
        $router->addRoute($pagination);
        $this->core = $core;
    }

    public function run()
    {
        $core = $this->core->set($this->router);

        $request = new Request(
            $_SERVER['REQUEST_METHOD'],
            explode('?', $_SERVER['REQUEST_URI'])[0],
            $_POST,
            $_GET
        );

        $response = $core->handleHttpRequest($request);

        $core->sendResponse($response);
    }

}