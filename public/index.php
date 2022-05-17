<?php

require_once dirname(__DIR__) . "/vendor/autoload.php";

use app\controllers\siteController;
use app\core\Application;

$app = new Application(dirname(__DIR__));
$app->router->get('/',[siteController::class,'home']);
$app->router->get('/contact',[siteController::class,'contact']);
$app->router->post('/contact',[siteController::class,'handleContact']);

$app->run();