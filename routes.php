<?php

$router->get('', 'PagesController@home');
$router->get('index', 'PagesController@home');
$router->get('home', 'PagesController@home');
$router->get('about', 'PagesController@about');
$router->get('contact', 'PagesController@contact');

$router->get('users', 'UsersController@index');
$router->post('users', 'UsersController@store');
$router->post('login', 'UsersController@login');
$router->get('logout', 'UsersController@logout');
$router->post('register', 'UsersController@register');

$router->get('lists', 'ItemsListsController@index');

$router->post('addItem', 'ItemsController@add');
$router->post('updateItem', 'ItemsController@update');
$router->post('deleteItem', 'ItemsController@delete');

