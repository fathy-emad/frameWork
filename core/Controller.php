<?php

namespace app\core;

class Controller
{
    public string $layout = 'main';

    public function setLayout($layout)
    {
        return $this->layout = $layout;
    }

    public function render($view, $params = [])
    {

        return Application::$application->router->renderView($view, $params);
    }

}