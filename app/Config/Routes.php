<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->group('api', function ($routes) {
  $routes->group('auth', function ($routes) {
    $routes->post('register', 'AuthController::register');
    $routes->post('login', 'AuthController::login');
    $routes->get('logout', 'AuthController::logout');
  });

  $routes->group('mobil', function ($routes) {
    $routes->get('/', 'MobilController::index');
    $routes->get('(:num)', 'MobilController::show/$1');
    $routes->post('/', 'MobilController::create');
    $routes->post('(:num)', 'MobilController::update/$1');
    $routes->delete('(:num)', 'MobilController::delete/$1');
  });
});
