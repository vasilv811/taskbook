<?php


namespace Core;


use App\Controllers\AdminController;
use App\Controllers\GetMessageController;
use App\Controllers\SetMessageController;
use App\Controllers\UpdateMessageController;
use App\Models\Admins;
use App\Controllers\IndexController;
use Core\Renderer;
use App\Controllers\PaginationController;
use App\Models\Tasks;
use App\Models\Users;
use App\Models\Emails;
use Core\Validator;


class DiContainer
{

    public object $classes;

    /**
     * DiContainer constructor.
     */
    public function __construct()
    {
        $this->setCoreClasses();
    }

    /**
     * @param $className
     * @return mixed
     * @throws \ReflectionException
     */
    public function diContainer($className): mixed
    {
        if (method_exists($this->classes->{$className}, '__construct') === true) {
            $class_instance = $this->params($this->classes->{$className});
        } else {
            $class_instance = new $className();
        }
        return $class_instance;
    }

    /**
     * @return array
     */
    public function getCoreClasses(): array
    {
        return [
            'IndexController' => IndexController::class,
            'PaginationController' => PaginationController::class,
            'SetMessageController' => SetMessageController::class,
            'AdminController' => AdminController::class,
            'GetMessageController' => GetMessageController::class,
            'UpdateMessageController' => UpdateMessageController::class,
            'renderer' => Renderer::class,
            'admins' => Admins::class,
            'tasks' => Tasks::class,
            'users' => Users::class,
            'emails' => Emails::class,
            'validator' => Validator::class,
            'templatesDir' => dirname(__DIR__ . '/../App/Views/Layouts/default.php'),

        ];
    }

    /**
     * @return object
     */
    protected function setCoreClasses(): object
    {
        return $this->classes = (object)$this->getCoreClasses();
    }

    /**
     * @param $className
     * @return object|bool
     * @throws \ReflectionException
     */
    protected function params($className): object|bool
    {
        $refMethod = new \ReflectionMethod($className, '__construct');
        $params = $refMethod->getParameters();

        $re_args = [];

        foreach ($params as $key => $param) {
            $class = $param->getType();
            if ($class !== null) {
                $re_args[$param->name] = $this->classes->{$param->name};
                if (method_exists($re_args[$param->name], '__construct') !== false) {
                    $re_args[$param->name] = $this->params($re_args[$param->name]);
                } else {
                    if (class_exists($this->classes->{$param->name}) !== false) {
                        $re_args[$param->name] = new $this->classes->{$param->name};
                    } else {
                        $re_args[$param->name] = $this->classes->{$param->name};
                    }
                }
            } else {
                return false;
            }
        }

        $refClass = new \ReflectionClass($className);
        return $refClass->newInstanceArgs((array)$re_args);
    }

}