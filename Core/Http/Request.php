<?php

namespace Core\Http;

class Request
{
public const METHOD_GET = 'GET';
public const METHOD_POST = 'POST';

    private string $method;
    private string $path;
    private array $postParam;
    private array $getParam;

    /**
     * Request constructor.
     * @param string $method
     * @param string $path
     * @param array $postParam
     * @param array $getParam
     */
    public function __construct(string $method, string $path, array $postParam = [], array $getParam = [])
    {
        $this->method = $method;
        $this->path = $path;
        $this->postParam = $postParam;
        $this->getParam = $getParam;
    }

    /**
     * @return array
     */
    public function getGetParam(): array
    {
        return $this->getParam;
    }

    /**
     * @param array $getParam
     */
    public function setGetParam(array $getParam): void
    {
        $this->getParam = $getParam;
    }

    /**
     * @return array
     */
    public function getPostParam(): array
    {
        return $this->postParam;
    }

    /**
     * @param array $postParam
     */
    public function setPostParam(array $postParam): void
    {
        $this->postParam = $postParam;
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