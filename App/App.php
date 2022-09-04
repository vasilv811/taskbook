<?php


namespace App;

use Core\Http\Request;
use Core\Routing\Route;
use Core\Routing\Router;
use Core\Core;


class App
{
    private $router;

    public function __construct()
    {
        session_start();

        $mainRoute = new Route (
            Request::METHOD_GET,
            '/',
            [
                'IndexController',
                'getMainPage'
            ]
        );

        $setMessage = new Route (
            Request::METHOD_POST,
            '/message/set',
            [
                'SetMessageController',
                'setMessage',
            ]
        );

        $adminCheck = new Route(
            Request::METHOD_POST,
            '/admin/check',
            [
                'AdminController',
                'getAdmins',
            ]
        );

        $adminOutput = new Route(
            Request::METHOD_POST,
            '/admin/output',
            [
                'AdminController',
                'getAdminOutput',
            ]
        );

        $getMessageByTaskId = new Route(
            Request::METHOD_POST,
            '/mesagebytaskid/get',
            [
                'GetMessageController',
                'getMessageByTaskId',
            ]
        );

        $adminStatus = new Route(
            Request::METHOD_POST,
            '/adminstatus/check',
            [
                'AdminController',
                'getStatusAdmin',
            ]
        );
//        dump($adminStatus);

        $changeMessage = new Route(
            Request::METHOD_POST,
            '/chengemessage/set',
            [
                'UpdateMessageController',
                'changeMessage',
            ]
        );

        $pagination = new Route(
            Request::METHOD_POST,
            '/paginations/get',
            [
                'PaginationController',
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
    }

    public function run()
    {
        $core = new Core($this->router);

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