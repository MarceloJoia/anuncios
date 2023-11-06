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
// $routes->get('detail/(:any)', 'DetailsController::details/$1', ['as' => 'adverts.detail']);
// $routes->get('user/(:any)', 'HomeController::userAdverts/$1', ['as' => 'adverts.user']);
// $routes->get('category/(:any)', 'HomeController::category/$1', ['as' => 'adverts.category']);
// $routes->get('category-city/(:any)/(:any)', 'HomeController::categoryCity/$1/$2', ['as' => 'adverts.category.city']);
$routes->get('pricing', 'HomeController::pricing', ['as' => 'pricing']);

// $routes->get('choice/(:num)', 'HomeController::choice/$1', ['as' => 'choice', 'filter' => 'auth_verified']);

// $routes->post('pay/(:num)', 'HomeController::attemptPay/$1', ['as' => 'pay']);

// $routes->post('toask/(:any)', 'DetailsController::toask/$1', ['as' => 'details.toask', 'filter' => 'auth']); // a resposta será realizada no Dashbord

// $routes->get('search', 'HomeController::search', ['as' => 'adverts.search']); // autocomplete dos templates main a advert
