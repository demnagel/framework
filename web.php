<?php

use \App\Controller\User as Us;

$router = \App\Core\Storage::get('router');

$router->get('/', \App\Controller\Index::class);
$router->get('/user', Us\ShowAll::class);
$router->get('/user/{id}', Us\Show::class);
$router->get('/user/{id}/update', Us\UpdatePage::class);
$router->get('/user/registration', Us\Create::class);
$router->get('/user/login', Us\Login::class);

$router->post('/user/auth', Us\Auth::class);
$router->post('/user/exit', Us\UnLogin::class);
$router->post('/user/registration', Us\Store::class);
$router->post('/user/{id}/update', Us\Update::class);
$router->post('/user/{id}/delete', Us\Delete::class);