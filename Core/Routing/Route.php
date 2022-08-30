<?php


namespace Core\Routing;


class Route
{
    private string $method;
    private string $path;
    private mixed $handler;

    /**
     * Route constructor.
     * @param string $method
     * @param string $path
     * @param $handler
     */
    public function __construct(string $method, string $path, $handler)
    {
        $this->method = $method;
        $this->path = $path;
        $this->handler = $handler;
    }


    /**
     * @return mixed
     */
    public function getHandler(): mixed
    {
        return $this->handler;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }
}