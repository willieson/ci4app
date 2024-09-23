<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index', ['as' => 'home']);
$routes->get('/dbtest', 'Home::connTest');
$routes->get('/login', 'LoginController::index', ['as' => 'login']);
$routes->get('/logout', 'LoginController::userLogout');
