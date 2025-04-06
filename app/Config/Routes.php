<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('menus', ['namespace' => 'App\Controllers'], function($routes) {
    $routes->get('/', 'MenuController::getAllMenu');
    $routes->get('add', 'MenuController::addMenu');
    $routes->post('saveMenu', 'MenuController::saveMenu');
    $routes->get('updateMenu/(:any)', 'MenuController::updateMenu/$1');
    $routes->post('update/(:any)', 'MenuController::updateData/$1');
    $routes->post('delete/(:any)', 'MenuController::deleteMenu/$1');
});

$routes->group('orders', ['namespace' => 'App\Controllers'], function($routes) {
    $routes->get('/', 'OrderItemsController::getOrder');
    $routes->post('add', 'OrderItemsController::addToCart');
    $routes->post('delete/(:any)', 'OrderItemsController::deleteOrder/$1');
});

$routes->group('transactions', ['namespace' => 'App\Controllers'], function($routes) {
    $routes->get('/', 'OrdersController::getTransactions');
    $routes->get('add', 'OrdersController::addTransaction');
    $routes->post('create', 'OrdersController::saveTransaction');
    $routes->post('update/(:any)', 'OrdersController::updateStatusPayment/$1');
});