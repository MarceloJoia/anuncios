<?php

$routes->group('{locale}/dashboard', ['namespace' => 'App\Controllers\Dashboard', 'filter' => 'auth:web'], function ($routes) {

    $routes->get('/', 'DashboardController::index', ['filter' => 'verified', 'as' => 'dashboard']);
    $routes->get('profile', 'DashboardController::profile', ['filter' => 'confirm', 'as' => 'profile']);
    $routes->put('profile-update', 'DashboardController::updateProfile', ['as' => 'profile.update']);


    // User ads
    $routes->group('adverts', ['namespace' => 'App\Controllers\Dashboard'], function ($routes) {

        $routes->get('my', 'AdvertsUserController::index', ['as' => 'my.adverts']);
        $routes->get('my-archived', 'AdvertsUserController::archived', ['as' => 'my.archived.adverts']);
        $routes->get('get-all-my-adverts', 'AdvertsUserController::getUserAdverts', ['as' => 'get.all.my.adverts']);
        $routes->get('get-all-my-archived-adverts', 'AdvertsUserController::getUserArchivedAdverts', ['as' => 'get.all.my.archived.adverts']);
        $routes->get('get-my-advert', 'AdvertsUserController::getUserAdvert', ['as' => 'get.my.advert']);
        $routes->get('edit-images/(:num)', 'AdvertsUserController::editUserAdvertImages/$1', ['as' => 'adverts.my.edit.images']);
        $routes->get('get-categories-situations', 'AdvertsUserController::getCategoriesAndSituations', ['as' => 'get.categories.situations']);
        $routes->post('create', 'AdvertsUserController::createUserAdvert', ['as' => 'adverts.create.my']);
        $routes->put('update', 'AdvertsUserController::updateUserAdvert', ['as' => 'adverts.update.my']);
        $routes->put('upload/(:num)', 'AdvertsUserController::uploadAdvertImages/$1', ['as' => 'adverts.upload.my']);
        $routes->delete('delete-image/(:any)', 'AdvertsUserController::deleteUserAdvertImage/$1', ['as' => 'adverts.delete.image']);
        $routes->put('archive', 'AdvertsUserController::archiveUserAdvert', ['as' => 'adverts.archive.my']);
        $routes->put('recover', 'AdvertsUserController::recoverUserAdvert', ['as' => 'adverts.recover.my']);
        $routes->delete('delete', 'AdvertsUserController::deleteUserAdvert', ['as' => 'adverts.delete.my']);
    });
});
