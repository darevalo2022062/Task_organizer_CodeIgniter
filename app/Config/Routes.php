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

// AUTH
$routes->group('auth', static function ($routes) {
    $routes->get('login', 'Auth::login', ['as' => 'auth.login']);
    $routes->post('login', 'Auth::attemptLogin');

    $routes->get('register', 'Auth::register', ['as' => 'auth.register']);
    $routes->post('register', 'Auth::attemptRegister');

    $routes->get('mail_verify', 'Auth::mailVerify', ['as' => 'auth.mail_verify']);
    $routes->post('mail_verify', 'Auth::attemptMailVerify');

    $routes->get('logout', 'Auth::logout', ['as' => 'auth.logout']);
});
