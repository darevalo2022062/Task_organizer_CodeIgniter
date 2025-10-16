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

// ? AUTH
$routes->group('auth',['filter' => 'guest'], static function ($routes) {
    //* login & register
    $routes->get('login', 'Auth::login', ['as' => 'auth.login']);
    $routes->post('login', 'Auth::attemptLogin', ['as'=> 'auth.login.submit']);
    $routes->get('register', 'Auth::register', ['as' => 'auth.register']);
    $routes->post('register', 'Auth::attemptRegister', ['as' => 'auth.register.submit']);
    //* email verification & logout
    $routes->get('mail-verify', 'AuthMail::mailVerifyView', ['as' => 'auth.mail_verify']);
    $routes->post('logout', 'Auth::logout', ['as' => 'auth.logout']);
    //* forgot password
    $routes->get('forgot-password', 'Auth::forgotPassword', ['as' => 'auth.forgot_password']);
    $routes->post('forgot-password-send-mail', 'AuthMail::forgotPasswordSendMail', ['as' => 'auth.forgot_password.send_mail']);
    $routes->post('forgot_password-new-password', 'Auth::forgotPasswordNewPassword', ['as' => 'auth.forgot_password.new_password']);
});

$routes->get('verify-email/(:num)/(:segment)', 'AuthMail::verifyEmail/$1/$2', ['as' => 'verify-email']);
$routes->get('new-password/(:num)/(:any)', 'AuthMail::newPassword/$1/$2', ['as' => 'new-password']);