<?php


namespace Core\Http;


class JsonResponse extends Response
{
    public function __construct(array $content, int $code = self::CODE_OK)
    {
        $headers = ['Content-Type: application/json'];

        parent::__construct(json_encode($content), $headers, $code);
    }

}