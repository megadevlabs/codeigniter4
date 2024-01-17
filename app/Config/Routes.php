<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->add('/test', 'Welcome::index');
//$routes->get('/info/(:any)/(:any)','Test::myInfo/$1/$2');
//$routes->get('/info/(:any)/(:alpha)','Test::myInfo/$1/$2');
//$routes->get('/info/(:any)/(:num)','Test::myInfo/$1/$2');

$routes->set404Override(function () {
  // Do something here
  return view('404');
});

// Check Filter Routs and Controller
$routes->group('', ['filter' => 'isLoggedin'], function ($routes) {
  $routes->get('', 'dashboard::index');
  $routes->get('index', 'dashboard::index');
  $routes->get('avatar', 'dashboard::avatar');
  $routes->get('login_activity', 'dashboard::login_activity');
  $routes->get('change_password', 'dashboard::change_password');
  $routes->get('edit_profile', 'dashboard::edit_profile');
});
