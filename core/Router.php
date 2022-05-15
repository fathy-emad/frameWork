<?php

namespace app\core;

class Router
{
    public Request $request;
    protected array $routes = [];

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param $path
     * @param $callback
     * @return void
     */
    public function get($path, $callback)
    {
        $this->routes["get"][$path] = $callback;
    }

    /**
     * @return void
     */
    public function resolve()
    {
       $path     =  $this->request->getPath();
       $method   = $this->request->getMethod();
       $callback = $this->routes[$method][$path];

       if (!$callback) { echo "no file"; exit(); }

       echo call_user_func($callback);
    }
}
