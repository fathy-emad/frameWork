<?php

namespace app\controllers;

use app\core\controller;

class authController extends controller
{
    public function login()
    {
        $this->setLayout("auth");
        return $this->render("login");
    }

    public function register()
    {
        $this->setLayout("auth");
        return $this->render("register");
    }
}