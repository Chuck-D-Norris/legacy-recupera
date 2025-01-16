<?php

namespace App\Core;

use App\Middlewares\MiddlewareInterface;
use Exception;

class Router
{
    protected const HTTP_METHODS = ['GET', 'POST', 'PUT', 'DELETE', 'PATCH'];

    public array $routes = [
        'GET' => [],
        'POST' => [],
        'PUT' => [],
        'DELETE' => [],
        'PATCH' => [],
    ];

    public function load(string $file): void
    {
        $data = require $file;
        foreach ($data as $method => $routes) {
            $this->routes[$method] = array_merge($this->routes[$method], $data[$method]);
        }
    }

    public function loadDir(string $dir): void
    {
        $files = glob("{$dir}/*.php");
        foreach ($files as $file) {
            $this->load($file);
        }
    }

    public function dispatch(string $requestMethod, string $requestUri, array $postData = []): void
    {
        // Automatically detect the content type
        $contentType = $_SERVER['CONTENT_TYPE'] ?? '';

        if (in_array($requestMethod, ['POST', 'PUT', 'DELETE'])) {
            if (strpos($contentType, 'application/json') !== false) {
                // Read the raw POST data
                $rawData = file_get_contents('php://input');

                // Decode the JSON into an associative array
                $postData = json_decode($rawData, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    $this->abort(400, 'Invalid JSON data');

                    return;
                }
            } elseif (strpos($contentType, 'application/x-www-form-urlencoded') !== false) {
                // Handle standard form data
                parse_str(file_get_contents('php://input'), $postData);
            }
        }

        if (! in_array($requestMethod, self::HTTP_METHODS)) {
            $this->abort(405, 'Method Not Allowed');

            return;
        }

        // Extract query parameters from the requestUri if any
        $queryParameters = [];
        if (strpos($requestUri, '?') !== false) {
            $queryParameters = explode('&', explode('?', $requestUri)[1]);
            $queryParameters = array_reduce($queryParameters, function ($carry, $item) {
                [$key, $value] = explode('=', $item);
                $carry[$key] = $value;

                return $carry;
            }, []);
            $requestUri = explode('?', $requestUri)[0];
        }

        // Match exact route
        if (isset($this->routes[$requestMethod][$requestUri])) {
            if ($requestMethod == 'GET') {
                $this->callRoute($this->routes[$requestMethod][$requestUri], ['queryParams' => $queryParameters]);
            } else {
                $this->callRoute($this->routes[$requestMethod][$requestUri], ['postData' => $postData]);
            }

            return;
        }

        // Match dynamic route with parameters and query parameters
        foreach ($this->routes[$requestMethod] as $route => $routeInfo) {
            $routePattern = preg_replace('/:\w+/', '([^/]+)', $route);
            if (preg_match("#^{$routePattern}$#", $requestUri, $matches)) {
                array_shift($matches);
                $params = $this->extractParams($route, $matches);

                if ($requestMethod === 'GET') {
                    $arguments = array_merge($params, ['queryParams' => $queryParameters]);
                    $this->callRoute($routeInfo, $arguments);

                    return;
                }

                if (in_array($requestMethod, ['POST', 'PUT', 'DELETE'])) {
                    $arguments = array_merge($params, ['postData' => $postData]);
                    $this->callRoute($routeInfo, $arguments);

                    return;
                }

                return;
            }
        }

        $this->abort(404, '¡No se ha encontrado la página!');
    }

    public function redirect(string $uri, int $statusCode = 302): void
    {
        http_response_code($statusCode);
        header("Location: {$uri}");
        exit;
    }

    protected function extractParams(string $route, array $matches): array
    {
        preg_match_all('/:(\w+)/', $route, $paramNames);

        return array_combine($paramNames[1], $matches);
    }

    protected function callRoute(array $routeInfo, array $arguments = []): void
    {
        if (! class_exists($routeInfo['controller'])) {
            $this->abort(500, "Controller {$routeInfo['controller']} not found");

            return;
        }

        if (! method_exists($routeInfo['controller'], $routeInfo['method'])) {
            $this->abort(500, "Method {$routeInfo['method']} not found in controller {$routeInfo['controller']}");

            return;
        }

        if (isset($routeInfo['middlewares'])) {
            $this->handleMiddlewares($routeInfo['middlewares']);
        }

        $controller = new $routeInfo['controller'];
        $controller->{$routeInfo['method']}(...$arguments);
    }

    protected function handleMiddlewares(array $middlewares): void
    {
        foreach ($middlewares as $middlewareClass) {
            if (! class_exists($middlewareClass)) {
                throw new Exception("Middleware class {$middlewareClass} not found");
            }

            $middleware = new $middlewareClass;
            if (! $middleware instanceof MiddlewareInterface) {
                throw new Exception("Middleware {$middlewareClass} must implement MiddlewareInterface");
            }

            $middleware->handle($_REQUEST, fn () => null);
        }
    }

    protected function abort(int $statusCode, string $message): void
    {
        View::render([
            'view' => 'Error',
            'title' => "Error $statusCode",
            'layout' => 'PublicLayout',
            'data' => [
                'code' => $statusCode,
                'message' => $message,
            ],
        ]);
        http_response_code($statusCode);
        exit;
    }
}
