<?php

namespace app\controllers;

use app\core\controller;

class siteController extends controller
{

    public function home()
    {
        $params = [
            "name" => "fathy"
        ];

        return $this->render("home",$params);
    }

    public function contact()
    {
        return $this->render("contact");
    }

    public function handleContact()
    {
        return "handling submitted data";
    }

}