<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('pages/welcome_message', 'Home::index');
$routes->get('pages/coba', 'Home::coba');
$routes->get('pages/contact', 'Home::contact');
$routes->get('komik/index', 'Komik::index');
$routes->get('/komik/create', 'Komik::create');
$routes->post('/komik/store', 'Komik::store');
$routes->get('/komik/edit/(:segment)', 'Komik::edit/$1');
$routes->post('/komik/update/(:num)', 'Komik::update/$1');
$routes->delete('/komik/(:num)', 'Komik::delete/$1');
$routes->get('/komik/(:any)', 'Komik::detail/$1');
