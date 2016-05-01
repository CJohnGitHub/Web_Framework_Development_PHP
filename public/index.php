<?php
require_once __DIR__ . '/../connections/setup.php';

session_start();

//Home Page
$app->get('/', 'Itb\Controller\MainController::indexAction');

//logging processing the log in actions
$app->post('/login', 'Itb\Controller\MainController::processLogInAction');

$app->get('/logout', 'Itb\Controller\MainController::killSession');

//Admin add student
$app->get('/addStudent', 'Itb\Controller\AdminController::addStudent');
$app->post('/processAddStudent', 'Itb\Controller\AdminController::processAddStudent');

/*
$connections->get('/list', 'Itb\Controller\MainController::listAction');

$connections->get('/show/{id}', 'Itb\Controller\MainController::showAction');

$connections->get('/show/', 'Itb\Controller\MainController::showMissingIsbnAction');
*/

$app->error(function (\Exception $e, $code) use ($app) {
    $errorController = new Itb\Controller\ErrorController();
    return $errorController->errorAction($app, $code);
});

$app->run();