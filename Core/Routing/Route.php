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
     * @param mixed $handler
     */
    public function setHandler(mixed $handler): void
    {
        $this->handler = $handler;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     */
    public function setMethod(string $method): void
    {
        $this->method = $method;
    }
}