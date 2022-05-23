<?php

namespace app\core;

class Router
{
    public Request $request;
    public Response $response;
    protected array $routes = [];

    public function __construct(Request $request, Response $response)
    {
        $this->response = $response;
        $this->request = $request;
    }

    public function get($path, $callback)
    {
        $this->routes["get"][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes["post"][$path] = $callback;
    }

    public function resolve()
    {
       $path = $this->request->getPath();
       $method = $this->request->method();
       $callback = $this->routes[$method][$path] ?? false;

       if (!$callback){

           $this->response->setStatusCode(404);
           return $this->renderView("404");
       }

       if (is_string($callback)){

           return $this->renderView($callback);
       }

       if (is_array($callback)){

           Application::$application->controller = new $callback[0]();
           $callback[0] = Application::$application->controller;
       }

       return call_user_func($callback, $this->request);

    }

    public function renderView($view,$params = [])
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view,$params);

        return str_replace('{{content}}',$viewContent,$layoutContent);
    }

    protected function layoutContent()
    {
        $layout = Application::$application->controller->layout;
        ob_start();
        include_once Application::$ROOT_DIR . '/views/layouts/' . $layout . '.php';
        return ob_get_clean();
    }

    protected function renderOnlyView($view,$params = [])
    {
        foreach ($params AS $key => $param) { $$key = $param; }

        ob_start();
        include_once Application::$ROOT_DIR . '/views/' . $view . '.php';
        return ob_get_clean();
    }


}
