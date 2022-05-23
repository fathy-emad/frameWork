<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;

class SiteController extends controller
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

    public function handleContact(Request $request)
    {
        $body = $request->getBody();
        echo "<pre>";
        print_r($body);
        echo "</pre>";
        exit();
        return "<pre>" . print_r($body) . "</pre>";
    }

}