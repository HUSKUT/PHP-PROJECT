<?php

namespace Routing;

use Routing\Route;
include 'Route.php';

class Router
{

    public array $routes = [];

    private static $_instance; // No type hinting because it's a static property

    public static function getInstance(): Router
    {
        if(!self::$_instance) { // If no instance then make one
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public static function resolve() {
        $url = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];
        $route = self::getInstance()->getRoute($url, $method);
        if (!$route) {
            echo '404';
            exit();
        }
        if ($method != $route->method) {
            echo 'Method not allowed';
            exit();
        }
        $routeAction = $route->action;
        if ($route->variables) {
            $routeAction($route->variables);
            exit();
        }
        $routeAction();
    }

    public static function get($url, $action): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            echo 'This route must be called with a get request';
            exit();
        }
        $route = new Route();
        $route->method = 'GET';
        $route->url = $url;
        $route->action = $action;
        $url = explode('/', $url);
        $res = preg_grep('/{(.*)}/', $url);
        if ($res) {
            foreach ($res as $key => $value) {
                $res[$key] = str_replace('{', '', $value);
                $res[$key] = str_replace('}', '', $res[$key]);

            }
            $res = array_values($res);
            $route->params = $res;
        }
        self::getInstance()->routes[] = $route;
    }
    private function getRoute(mixed $url, mixed $method)
    {
        foreach ($this->routes as $route) {
            if ($route->url === $url && $route->method === $method) {
                return $route;
            } else {
                if (!str_contains($route->url, '{') && !str_contains($route->url, '}')) {
                    continue;
                }

                $arr = explode('/', $url);
                $val = array_pop($arr);
                $url = implode('/', $arr);

                $arr2 = explode('/', $route->url);
                array_pop($arr2);
                $route->url = implode('/', $arr2);
                if ($route->url === $url && $route->method === $method) {
                    $route->variables[$route->params[0]] = $val;
                    return $route;
                }
            }
        }
        return null;
    }


}