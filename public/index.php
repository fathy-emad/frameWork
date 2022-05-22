<?php

require_once dirname(__DIR__) . "/vendor/autoload.php";

use app\controllers\authController;
use app\controllers\siteController;
use app\core\Application;

$app = new Application(dirname(__DIR__));
$app->router->get('/',[siteController::class,'home']);
$app->router->get('/contact',[siteController::class,'contact']);
$app->router->post('/contact',[siteController::class,'handleContact']);
$app->router->get('/login',[authController::class,'login']);
$app->router->post('/login',[authController::class,'login']);
$app->router->get('/register',[authController::class,'register']);
$app->router->post('/contact',[authController::class,'contact']);

$app->run();