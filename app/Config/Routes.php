<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index', ['filter' => 'auth']);

$routes->group('sekolah', function($routes) {
    $routes->get('', 'Sekolah::index', ['filter' => 'auth']);
    $routes->get('create', 'Sekolah::create', ['filter' => 'auth']);
    $routes->post('store', 'Sekolah::store', ['filter' => 'auth']);
    $routes->get('show/(:num)', 'Sekolah::show/$1', ['filter' => 'auth']);
    $routes->get('edit/(:num)', 'Sekolah::edit/$1', ['filter' => 'auth']);
    $routes->post('update/(:num)', 'Sekolah::update/$1', ['filter' => 'auth']);
    $routes->post('delete/(:num)', 'Sekolah::delete/$1', ['filter' => 'auth']);
});

$routes->group('buku', function($routes){
    $routes->get('', 'Buku::index', ['filter' => 'auth']);
    $routes->get('create', 'Buku::create', ['filter' => 'auth']);
    $routes->post('store', 'Buku::store', ['filter' => 'auth']);
    $routes->get('show/(:num)', 'Buku::show/$1', ['filter' => 'auth']);
    $routes->get('edit/(:num)', 'Buku::edit/$1', ['filter' => 'auth']);
    $routes->post('update/(:num)', 'Buku::update/$1', ['filter' => 'auth']);
    $routes->post('delete/(:num)', 'Buku::delete/$1', ['filter' => 'auth']);
});

$routes->group('user', function($routes){
    $routes->get('', 'User::index', ['filter' => 'auth']);
    $routes->get('create', 'User::create', ['filter' => 'auth']);
    $routes->post('store', 'User::store', ['filter' => 'auth']);
    $routes->get('show/(:num)', 'User::show/$1', ['filter' => 'auth']);
    $routes->get('edit/(:num)', 'User::edit/$1', ['filter' => 'auth']);
    $routes->post('update/(:num)', 'User::update/$1', ['filter' => 'auth']);
    $routes->post('delete/(:num)', 'User::delete/$1', ['filter' => 'auth']);
    $routes->get('login', 'User::login');
    $routes->post('login', 'User::login');
    $routes->get('logout', 'User::logout', ['filter' => 'auth']);
    $routes->get('changepassword', 'User::changepassword', ['filter' => 'auth']);
    $routes->post('changepassword', 'User::changepassword', ['filter' => 'auth']);
});

$routes->group('auditlog', function($routes){
    $routes->get('', 'AuditLog::index', ['filter' => 'auth']);
    $routes->get('detail/(:num)', 'AuditLog::detail/$1', ['filter' => 'auth']);
});

$routes->get('siswa', 'Siswa::create');
$routes->post('siswa/login', 'Siswa::login');
$routes->get('kategori', 'kategoriBuku::index');
$routes->get('kategori/create', 'kategoriBuku::create');
$routes->post('kategori/create', 'KategoriBuku::create');