<?php

require dirname(__DIR__) . '/Bootstrap/bootstrap.php';
session_start();
$container = new \Core\DiContainer(
    [
        \Core\Renderer::class => new \Core\Renderer(dirname(__DIR__ . '/../App/Views/Layouts/default.php')),
    ]
);
$run = $container->get(\App\App::class);

$run->run();