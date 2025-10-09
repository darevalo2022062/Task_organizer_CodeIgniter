<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ? ORDER ROUTES

// * Main Page
$routes->get('/', 'Home::index');

// * Switch Language
$routes->get('lang/(:alpha)', 'Locale::switch/$1');

