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

$routes->group('buku', function($routes){
    $routes->get('', 'buku::index');
    $routes->get('create', 'Buku::create');
    $routes->post('store', 'Buku::store');
    $routes->get('edit/(:num)', 'Buku::edit/$1');
    $routes->post('update/(:num)', 'Buku::update/$1');
    $routes->get('delete/(:num)', 'Buku::delete/$1');
});

$routes->get('siswa', 'Siswa::create');
$routes->post('siswa/login', 'Siswa::login');
