<?php
use Controllers\Controller;
use Controllers\UserController;
use Routing\Router;
include 'Routing/Router.php';
include 'Controllers/Controller.php';
include 'Controllers/UserController.php';

// Use like this:
// Router::get('/', fn() => Method::Name());
// or
// Router::get('/', function () { echo 'test'; });

Router::get('/', fn() => Controller::test());
Router::get('/test', function () {
    echo 'test123';
});
Router::get('/products/{products}', fn($product) => Controller::product($product));
Router::get('/users/{id}', fn($id) => UserController::show($id));

Router::resolve();
