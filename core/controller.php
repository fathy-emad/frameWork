<?php

namespace app\core;

class controller
{
    public function render($view, $params = [])
    {
        return Application::$application->router->renderView($view, $params);
    }

}