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

    $routes->get('mail-verify', 'Auth::mailVerifyView', ['as' => 'auth.mail_verify']);
    $routes->post('logout', 'Auth::logout', ['as' => 'auth.logout']); // (si lo usas)
});

$routes->get('verify-email/(:num)/(:segment)', 'Auth::verifyEmail/$1/$2', ['as' => 'verify-email']);

