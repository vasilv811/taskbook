<?php

use Core\Http\Request;
use Core\Routing\Route;
use App\Controllers\IndexController;
use Core\Routing\Router;
use Core\Core;
use Core\Renderer;
use App\Controllers\SetMessageController;
use App\Models\Tasks;
use Core\Validator;
use App\Controllers\GetMessageController;
use App\Controllers\GetNameController;
use App\Controllers\PaginationController;

require dirname(__DIR__) . '/Config/libs.php';

$renderer = new Renderer(dirname(__DIR__ . '/../App/Views/Layouts/default.php'));
$tasks = new Tasks();
$validator = new Validator();

$request = new Request(
    $_SERVER['REQUEST_METHOD'],
    explode('?', $_SERVER['REQUEST_URI'])[0],
    $_POST,
    $_GET
);

$mainRoute = new Route (
    Request::METHOD_GET,
    '/',
    [
        new IndexController($renderer),
        'getMainPage'
    ]
);

$setMessage = new Route (
    Request::METHOD_POST,
    '/message/set',
    [
        new SetMessageController($tasks, $validator),
        'setMessage',
    ]
);

$getMessage = new Route (
    Request::METHOD_POST,
    '/message/get',
    [
        new GetMessageController($tasks),
        'getMessage',
    ]
);

$getName = new Route (
    Request::METHOD_POST,
    '/name/get',
    [
        new GetNameController($tasks),
        'getName',
    ]
);

$getCountPagination = new Route (
    Request::METHOD_POST,
    '/paginationCount/get',
    [
        new PaginationController($tasks),
        'getAllTasks',
    ]
);

$getPagination = new Route (
    Request::METHOD_POST,
    '/pagination/get',
    [
        new PaginationController($tasks),
        'getPagination',
    ]
);

$router = new Router();
$router->addRoute($mainRoute);
$router->addRoute($setMessage);
$router->addRoute($getMessage);
$router->addRoute($getName);
$router->addRoute($getCountPagination);
$router->addRoute($getPagination);

$core = new Core($router);

$response = $core->handleHttpRequest($request);

$core->sendResponse($response);