<?php

use Core\Http\Request;
use Core\Routing\Route;
use App\Controllers\IndexController;
use Core\Routing\Router;
use Core\Core;
use Core\Renderer;
use App\Controllers\SetMessageController;
use App\Models\Tasks;
use App\Models\Users;
use App\Models\Emails;
use App\Models\Admins;
use Core\Validator;
use App\Controllers\GetMessageController;
use App\Controllers\PaginationController;
use App\Controllers\AdminController;
use App\Controllers\UpdateMessageController;


require dirname(__DIR__) . '/Config/libs.php';
session_start();
$renderer = new Renderer(dirname(__DIR__ . '/../App/Views/Layouts/default.php'));
$tasks = new Tasks();
$users = new Users();
$emails = new Emails();
$admins = new Admins();
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
        new SetMessageController($tasks, $users, $emails, $validator),
        'setMessage',
    ]
);

$getCountPagination = new Route (
    Request::METHOD_POST,
    '/paginationcount/get',
    [
        new PaginationController($tasks),
        'getAllTasks',
    ]
);

$getCountPaginationEmail = new Route (
    Request::METHOD_POST,
    '/paginationemailpage/get',
    [
        new PaginationController($tasks),
        'getAllTasksEmails',
    ]
);

$getCountPaginationUsers = new Route (
    Request::METHOD_POST,
    '/paginationuserpage/get',
    [
        new PaginationController($tasks),
        'getAllTasksUser',
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

$adminCheck = new Route(
    Request::METHOD_POST,
    '/admin/check',
    [
        new AdminController($tasks),
        'getAdmins',
    ]
);

$adminOutput = new Route(
    Request::METHOD_POST,
    '/admin/output',
    [
        new AdminController($tasks),
        'getAdminOutput',
    ]
);

$getMessageByTaskId = new Route(
    Request::METHOD_POST,
    '/mesagebytaskid/get',
    [
        new GetMessageController($tasks),
        'getMessageByTaskId',
    ]
);

$adminStatus = new Route(
    Request::METHOD_POST,
    '/adminstatus/check',
    [
        new AdminController($tasks),
        'getStatusAdmin',
    ]
);


$changeMessage = new Route(
    Request::METHOD_POST,
    '/chengemessage/set',
    [
        new UpdateMessageController($tasks, $validator),
        'chengeMessage',
    ]
);

$paginationUser = new Route(
    Request::METHOD_POST,
    '/paginationusers/get',
    [
        new PaginationController($tasks),
        'getPaginationUsers',
    ]
);

$paginationStatusFinished = new Route(
    Request::METHOD_POST,
    '/paginationstatusfinishedpage/get',
    [
        new PaginationController($tasks),
        'getPaginationStatusFinished',
    ]
);

$paginationStatusNonFinished = new Route(
    Request::METHOD_POST,
    '/paginationstatusnonfinishedpage/get',
    [
        new PaginationController($tasks),
        'getPaginationStatusNonFinished',
    ]
);

$getStartPaginationUsers = new Route(
    Request::METHOD_POST,
    '/paginationcountusers/get',
    [
        new PaginationController($tasks),
        'getStartPaginationUsers',
    ]
);

$paginationEmail = new Route(
    Request::METHOD_POST,
    '/paginationemail/get',
    [
        new PaginationController($tasks),
        'getPaginationEmail',
    ]
);

$paginationTaskComplete = new Route(
    Request::METHOD_POST,
    '/paginationucomplete/get',
    [
        new PaginationController($tasks),
        'getPaginationTaskComplete',
    ]
);

$paginationTaskNotComplete = new Route(
    Request::METHOD_POST,
    '/paginationnotcomplete/get',
    [
        new PaginationController($tasks),
        'getPaginationTaskNotComplete',
    ]
);

$router = new Router();
$router->addRoute($mainRoute);
$router->addRoute($setMessage);
$router->addRoute($getCountPagination);
$router->addRoute($getPagination);
$router->addRoute($adminCheck);
$router->addRoute($adminOutput);
$router->addRoute($getMessageByTaskId);
$router->addRoute($adminStatus);
$router->addRoute($changeMessage);
$router->addRoute($paginationUser);
$router->addRoute($getStartPaginationUsers);
$router->addRoute($paginationEmail);
$router->addRoute($paginationTaskComplete);
$router->addRoute($paginationTaskNotComplete);
$router->addRoute($getCountPaginationEmail);
$router->addRoute($getCountPaginationUsers);
$router->addRoute($paginationStatusFinished);
$router->addRoute($paginationStatusNonFinished);

$core = new Core($router);

$response = $core->handleHttpRequest($request);

$core->sendResponse($response);