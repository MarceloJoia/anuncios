<?php

$routes->group('{locale}/dashboard', ['namespace' => 'App\Controllers\Dashboard', 'filter' => 'auth:web'], function ($routes) {

    $routes->get('/', 'DashboardController::index', ['filter' => 'verified', 'as' => 'dashboard']);

    // User ads
    $routes->group('adverts', ['namespace' => 'App\Controllers\Dashboard'], function ($routes) {

        $routes->get('my', 'AdvertsUserController::index', ['as' => 'my.adverts']);
        $routes->get('get-all-my-adverts', 'AdvertsUserController::getUserAdverts', ['as' => 'get.all.my.adverts']);
        $routes->get('get-my-advert', 'AdvertsUserController::getUserAdvert', ['as' => 'get.my.advert']);
        $routes->put('update', 'AdvertsUserController::updateUserAdvert', ['as' => 'adverts.update.my']);
        $routes->post('create', 'AdvertsUserController::createUserAdvert', ['as' => 'adverts.create.my', 'filter' => 'adverts']);

    });
});
