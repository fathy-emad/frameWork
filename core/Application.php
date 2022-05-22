<?php

namespace app\core;

class Application
{
    public static string $ROOT_DIR;
    public static Application $application;
    public Request $request;
    public Router $router;
    public Response $response;
    public Controller $controller;

    public function __construct($rootPath)
    {
        self::$ROOT_DIR = $rootPath;
        self::$application = $this;
        $this->response = new Response();
        $this->request = new Request();
        $this->router = new Router($this->request, $this->response);
    }

    public function getController()
    {
        return $this->controller;
    }

    public function setController(Controller $controller)
    {
       $this->controller = $controller;
    }

    public function run()
    {
        echo $this->router->resolve();
    }
}
