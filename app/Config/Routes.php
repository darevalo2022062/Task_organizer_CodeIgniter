<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/productos', 'Productos::index');
$routes->get('/productos/(:num)','Productos::show/$1');
$routes->view('productList/(:alpha)', 'lista_productos');
$routes->post('productos/guarda', 'Productos::guarda');
$routes->get('/productos/nuevo', 'Productos::nuevo');

$routes->group('admin', static function ($routes){
    $routes->get('/productos','Admin\Productos::index');
});