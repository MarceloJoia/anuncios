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
if (file_exists($dashboard = ROOTPATH . 'routes/dashboard.php')) {
    require $dashboard;
}


// Rotas para a API REST
if (file_exists($api = ROOTPATH . 'routes/api.php')) {
    require $api;
}

// Rota do auth packege
\Fluent\Auth\Facades\Auth::routes();


$routes->get('image/(:any)/(:any)', 'DetailsController::image/$1/$2', ['as' => 'web.image']);

$routes->get('pricing', 'HomeController::pricing', ['as' => 'pricing']);

$routes->get('choice/(:num)', 'HomeController::choice/$1', ['as' => 'choice', 'filter' => 'auth_verified']);

