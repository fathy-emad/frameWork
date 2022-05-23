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

    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->{$property};
        }
    }

    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->{$property} = $value;
        }
    }

    public function run()
    {
        echo $this->router->resolve();
    }
}
