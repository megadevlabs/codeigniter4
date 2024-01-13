<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index'); 
$routes->add('/test','Welcome::index');
//$routes->get('/info/(:any)/(:any)','Test::myInfo/$1/$2');
//$routes->get('/info/(:any)/(:alpha)','Test::myInfo/$1/$2');
//$routes->get('/info/(:any)/(:num)','Test::myInfo/$1/$2');