<?php

$routes->group('{locale}/manager', ['namespace' => 'App\Controllers\Manager', 'filter' => 'auth:web'], function ($routes) {

    $routes->get('/', 'ManagerController::index', ['as' => 'manager']);

    // Categories
    $routes->group('categories', function ($routes) {
        $routes->get('/', 'CategoriesController::index', ['as' => 'categories']);
        $routes->get('archived', 'CategoriesController::archived', ['as' => 'categories.archived']);
        $routes->get('get-all', 'CategoriesController::getAllCategories', ['as' => 'categories.get.all']);
        $routes->get('get-all-archived', 'CategoriesController::getAllArchivedCategories', ['as' => 'categories.get.all.archived']);
        $routes->get('get-info', 'CategoriesController::getCategoryInfo', ['as' => 'categories.get.info']);
        $routes->get('get-parents', 'CategoriesController::getDropdownParents', ['as' => 'categories.parents']);


        $routes->post('create', 'CategoriesController::create', ['as' => 'categories.create']);
        $routes->put('update', 'CategoriesController::update', ['as' => 'categories.update']);
        $routes->put('archive', 'CategoriesController::archive', ['as' => 'categories.archive']);
        $routes->put('recover', 'CategoriesController::recover', ['as' => 'categories.recover']);
        $routes->delete('delete', 'CategoriesController::delete', ['as' => 'categories.delete']);
    });

    // Plans
    $routes->group('plans', function ($routes) {

        $routes->get('/', 'PlansController::index', ['as' => 'plans']);
        $routes->get('archived', 'PlansController::archived', ['as' => 'plans.archived']);
        $routes->get('get-all', 'PlansController::getAllPlans', ['as' => 'plans.get.all']);
        $routes->get('get-all-archived', 'PlansController::getAllArchived', ['as' => 'plans.get.all.archived']);
        $routes->get('get-info', 'PlansController::getPlanInfo', ['as' => 'plans.get.info']);
        $routes->get('get-recorrences', 'PlansController::getRecorrences', ['as' => 'plans.get.recorrences']);

        $routes->post('create', 'PlansController::create', ['as' => 'plans.create']);
        $routes->put('update', 'PlansController::update', ['as' => 'plans.update']);
        $routes->put('archive', 'PlansController::archive', ['as' => 'plans.archive']);
        $routes->put('recover', 'PlansController::recover', ['as' => 'plans.recover']);
        $routes->delete('delete', 'PlansController::delete', ['as' => 'plans.delete']);
    });
});
