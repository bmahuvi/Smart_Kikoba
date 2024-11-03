<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('api', function (RouteCollection $routes) {
    $routes->group('user', function (RouteCollection $routes) {
        $routes->post('/', 'UserController::create');
        $routes->post('login', 'UserController::login');
        $routes->get('(:num)', 'UserController::show/$1');
    });

    $routes->group('group', function (RouteCollection $routes) {
        $routes->post('/', 'GroupController::create');
        $routes->get('(:num)', 'GroupController::show/$1');
    });
    $routes->group('member', function (RouteCollection $routes) {
        $routes->post('/', 'MemberController::create');
        $routes->put('/', 'MemberController::updateMember');
        $routes->get('/', 'MemberController::index');
        $routes->get('(:num)', 'MemberController::show/$1');
        $routes->delete('(:num)', 'MemberController::delete/$1');
    });
    $routes->group('saving', function (RouteCollection $routes) {
        $routes->post('/', 'SavingController::create');
        $routes->put('(:num)', 'SavingController::update/$1');
    });
});
