<?php

session_start();

require '../src/config/config.php';
require '../vendor/autoload.php';
require SRC . 'helper.php';

header('Content-Type: application/json');

$router = new Project\Router($_SERVER["REQUEST_URI"]);
$router->get('/logout', "PlayerController@logout");
$router->prefix('/types', [
    $router->get('/', "TypeController@getTypes")->middleware(['PlayerIsLogued', 'PlayerIsAdmin']),
    $router->post('/', "TypeController@create")->middleware(['PlayerIsLogued', 'PlayerIsAdmin']),
    $router->delete('/:id', "TypeController@delete")->middleware(['PlayerIsLogued', 'PlayerIsAdmin']),
]);

$router->post('/login', "PlayerController@login")->middleware(['PlayerIsNotLogued']);
$router->post('/register', "PlayerController@register")->middleware(['PlayerIsNotLogued']);

$router->run();
