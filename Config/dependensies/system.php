<?php

return [
    'Renderer' => function () {
        return new \Core\Renderer(dirname(__DIR__ . '/../App/Views/Layouts/default.php'));
    },
    'Request' => function () {
        return new \Core\Http\Request(
            $_SERVER['REQUEST_METHOD'],
            explode('?', $_SERVER['REQUEST_URI'])[0],
            $_POST,
            $_GET
        );
    },
'Route' => function (\Psr\Container\ContainerInterface $c) {
    return new \Core\Routing\Route()
}
];