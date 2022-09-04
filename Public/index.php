<?php
use App\Controllers\IndexController;
use App\Controllers\SetMessageController;
use Core\Renderer;


require dirname(__DIR__) . '/Bootstrap/bootstrap.php';
//var_dump(method_exists(IndexController::class, 'getMainPage'));
//$di = new \Core\DiContainer();
//
//$di = $di->diContainer('IndexController');
//var_dump($di);
$run = new App\App();
$run->run();