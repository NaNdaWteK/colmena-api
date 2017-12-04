<?php
$router = new Router();

$routes = [
    $router->doRequest('avatar', 'get') => true,
    $router->doRequest('avatar', 'store') => true,
];

if(!isset($routes[true])){
    $router->sendError();
}
