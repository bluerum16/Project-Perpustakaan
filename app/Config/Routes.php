<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('sekolah', function($routes) {
    $routes->get('', 'Sekolah::index');
    $routes->get('create', 'Sekolah::create');
    $routes->post('store', 'Sekolah::store');
    $routes->get('show/(:num)', 'Sekolah::show/$1');
    $routes->get('edit/(:num)', 'Sekolah::edit/$1');
    $routes->post('update/(:num)', 'Sekolah::update/$1');
    $routes->post('delete/(:num)', 'Sekolah::delete/$1');
});