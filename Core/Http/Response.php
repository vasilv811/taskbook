<?php


namespace Core\Http;


class Response
{
    const CODE_OK = 200;
    const CODE_NOT_FOUND = 404;
    const CODE_INTERNAL_ERROR = 500;

    private string $content;
    private array $headers;
    private int $code;

    public function __construct(string $content, array $headers = [], int $code = self::CODE_OK)
    {
        $this->content = $content;
        $this->headers = $headers;
        $this->code = $code;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @param int $code
     */
    public function setCode(int $code): void
    {
        $this->code = $code;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     */
    public function setHeaders(array $headers): void
    {
        $this->headers = $headers;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

}