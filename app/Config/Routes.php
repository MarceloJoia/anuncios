<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::index', ['as' => 'web.home']);


// Rotas para o manager
if (file_exists($manager = ROOTPATH . 'routes/manager.php')) {
    require $manager;
}

// Rotas para a API REST
if (file_exists($api = ROOTPATH . 'routes/api.php')) {
    require $api;
}

// Rota do auth packege
\Fluent\Auth\Facades\Auth::routes();
///// REMOVER ISSO
$routes->group('dashboard', ['filter' => 'auth:web'], function ($routes) {
    $routes->get('/', 'HomeController::dashboard', ['filter' => 'verified']);
    $routes->get('confirm', 'HomeController::confirm', ['filter' => 'confirm']);
});
