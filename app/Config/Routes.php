<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/dbtest', 'Home::connTest');
$routes->get('/login', 'LoginController::index');
$routes->get('/logout', 'LoginController::userLogout');
