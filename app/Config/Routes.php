<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/contacts', 'Contacts::index');
$routes->get('/contacts/create', 'Contacts::create');
$routes->post('/contacts/store', 'Contacts::store');
$routes->get('/contacts/edit/(:num)', 'Contacts::edit/$1');
$routes->post('/contacts/update/(:num)', 'Contacts::update/$1');
$routes->post('/contacts/delete/(:num)', 'Contacts::delete/$1');
