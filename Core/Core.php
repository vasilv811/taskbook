<?php


namespace Core;


use Core\Http\Request;
use Core\Http\Response;
use Core\Routing\Router;

class Core
{
    private Router $router;

    public function __construct(Router $router)
{
    $this->router = $router;
}

    public function handleHttpRequest(Request $request): Response
    {
        $route = $this->router->getRouteForRequest($request);

        if (!$route) {
            return new Response('Такая страница не найдена. Ошибка 404', [], Response::CODE_NOT_FOUND);
        }
        $handler = $route->getHandler();
        if (
            is_array($handler)
            && count($handler) === 2
            && is_object($handler[0])
            && method_exists($handler[0], $handler[1])
        ) {
            $controller = $handler[0];
            $method = $handler[1];
            $response = $controller->$method($request);
        } else {
            return new Response('Что-то пошло не так. Ошибка 500', [], Response::CODE_INTERNAL_ERROR);
        }
        return $response;
    }

    /**
     * Отправляет ответ
     * @param Response $response
     */
    public function sendResponse(Response $response): void
    {
        http_response_code($response->getCode());
        $headers = $response->getHeaders();
        if ($headers) {
            foreach ($headers as $header) {
                header($header);
            }
        }
        echo $response->getContent();
    }

}