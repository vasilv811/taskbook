<?php

use Core\Http\Request;
use Core\Routing\Route;
use App\Controllers\IndexController;
use Core\Routing\Router;
use Core\Core;
use Core\Renderer;

require dirname(__DIR__) . '/Config/libs.php';

$renderer = new Renderer(dirname(__DIR__ . '/../App/Views/Layouts/default.php'));

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

$router = new Router();
$router->addRoute($mainRoute);

$core = new Core($router);

$response = $core->handleHttpRequest($request);

$core->sendResponse($response);