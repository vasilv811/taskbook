<?php


namespace Core\Routing;


use Core\Http\Request;

class Router
{
    /**
     * @var array|Route[];
     */
    private array $routes;

    /**
     * @param Route $route
     * @return $this
     */
    public function addRoute(Route $route): self
    {
        $this->routes[] = $route;
        return $this;
    }

    /**
     * @param Request $request
     * @return Route|null
     */
    public function getRouteForRequest(Request $request): ?Route
    {
        foreach ($this->routes as $route) {
            if (
                $route->getMethod() === $request->getMethod() && $route->getPath() === $request->getPath()
            ) {
                return $route;
            }
        }
        return null;
    }
}