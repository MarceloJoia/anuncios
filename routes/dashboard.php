<?php

$routes->group('{locale}/dashboard', ['namespace' => 'App\Controllers\Dashboard', 'filter' => 'auth:web'], function ($routes) {

    $routes->get('/', 'DashboardController::index', ['filter' => 'verified', 'as' => 'dashboard']);

    // User ads
    $routes->group('adverts', ['namespace' => 'App\Controllers\Dashboard'], function ($routes) {

        $routes->get('my', 'AdvertsUserController::index', ['as' => 'my.adverts']);
        $routes->get('get-all-my-adverts', 'AdvertsUserController::getUserAdverts', ['as' => 'get.all.my.adverts']);
        $routes->get('get-my-advert', 'AdvertsUserController::getUserAdvert', ['as' => 'get.my.advert']);
        $routes->get('edit-images/(:num)', 'AdvertsUserController::editUserAdvertImages/$1', ['as' => 'adverts.my.edit.images']);
        $routes->get('get-categories-situations', 'AdvertsUserController::getCategoriesAndSituations', ['as' => 'get.categories.situations']);

        $routes->post('create', 'AdvertsUserController::createUserAdvert', ['as' => 'adverts.create.my']);

        $routes->put('update', 'AdvertsUserController::updateUserAdvert', ['as' => 'adverts.update.my']);
        $routes->put('upload/(:num)', 'AdvertsUserController::uploadAdvertImages/$1', ['as' => 'adverts.upload.my']);
        
        $routes->delete('delete-image/(:any)', 'AdvertsUserController::deleteUserAdvertImage/$1', ['as' => 'adverts.delete.image']);
    });
});
