<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index', ['as' => 'home']);
$routes->get('/market', 'Home::market', ['as' => 'market']);
$routes->get('/cimol', 'Home::getCimol', ['as' => 'cimol']);
$routes->get('math/generate', 'Home::generate'); // Route untuk menghasilkan soal
$routes->post('check_answer', 'Home::checkAnswer'); // Route untuk memeriksa jawaban

$routes->get('/dbtest', 'Home::connTest');
$routes->get('/login', 'LoginController::index', ['as' => 'login']);
$routes->get('/logout', 'LoginController::userLogout', ['as' => 'logout']);
