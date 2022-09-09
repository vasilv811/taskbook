<?php


namespace Core;


use App\Interfaces\ContainerInterface;


class DiContainer implements ContainerInterface
{

    /**
     * @var array
     */
    private array $objects;

    /**
     * DiContainer constructor.
     */
    public function __construct(array $objects = [])
    {
        $this->objects = $objects;
        $this->objects[self::class] = $this;
    }

    /**
     * @param $id
     * @return mixed
     * @throws \ReflectionException
     */
    public function get($id): mixed
    {
        if (array_key_exists($id, $this->objects)) {
            return $this->objects[$id];
        }

        if (method_exists($id, '__construct') === true) {
            $class_instance = $this->params($id);
        } else {
            $class_instance = new $id();
        }
        return $this->objects[$id] = $class_instance;
    }

    /**
     * @param $id
     * @return object|bool
     * @throws \ReflectionException
     */
    protected function params($id): object|bool
    {
        $refMethod = new \ReflectionMethod($id, '__construct');
        $params = $refMethod->getParameters();
        if (empty($params)) {
            return new $id;
        }
        $re_args = [];
        foreach ($params as $key => $param) {
            $class = $param->getType();
            if ($class !== null && $class->isBuiltin() === false) {
                $re_args[$param->name] = $class->getName();
                if (method_exists($re_args[$param->name], '__construct') !== false) {
                    $re_args[$param->name] = $this->get($re_args[$param->name]);
                } else {
                    if (class_exists($class) !== false) {
                        $re_args[$param->name] = new ($class->getName());
                    } else {
                        $re_args[$param->name] = $id;
                    }
                }
            } elseif ($class->isBuiltin() === true) {
                $re_args[$param->name] = $param->getDefaultValue();
            } else {
                return false;
            }
        }

        $refClass = new \ReflectionClass($id);
        return $refClass->newInstanceArgs((array)$re_args);
    }

    public function has($id): bool
    {
        return isset($this->objects[$id]);
    }

}