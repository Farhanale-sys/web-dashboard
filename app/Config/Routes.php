<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/login', 'Auth::login');
$routes->get('/register', 'Auth::register');
$routes->post('/login_action', 'Auth::login_action');
$routes->post('/register_action', 'Auth::register_action');
$routes->get('/logout', 'Auth::logout');
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/add_user', 'Dashboard::add_user');
$routes->post('/save_user', 'Dashboard::save_user');

