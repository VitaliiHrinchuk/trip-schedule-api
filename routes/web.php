<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

# ------------- AUTH -------------
$router->post('/login', [
  'uses' => 'AuthController@login',
]);

$router->post('/register', [
  'middleware' => ['auth'],
  'uses' => 'AuthController@register',
]);

# ------------- CITY -------------
$router->post('/cities/bulk', [
  'uses' => 'CityController@store',
]);
$router->get('/cities', [
  'uses' => 'CityController@index',
]);

# ------------- COMPANY -------------
$router->post('/companies', [
  'middleware' => ['auth'],
  'uses' => 'CompanyController@store',
]);
$router->get('/companies/{uuid}', [
  'uses' => 'CompanyController@show',
]);
$router->put('/companies/{uuid}', [
  'middleware' => ['auth'],
  'uses' => 'CompanyController@update',
]);
$router->delete('/companies/{uuid}', [
  'middleware' => ['auth'],
  'uses' => 'CompanyController@destroy',
]);

# ------------- TRANSPORT TYPE -------------
$router->post('/transport-type', [
  'middleware' => ['auth'],
  'uses' => 'TransportTypeController@store',
]);
$router->get('/transport-type/{uuid}', [
  'uses' => 'TransportTypeController@show',
]);
$router->put('/transport-type/{uuid}', [
  'middleware' => ['auth'],
  'uses' => 'TransportTypeController@update',
]);
$router->delete('/transport-type/{uuid}', [
  'middleware' => ['auth'],
  'uses' => 'TransportTypeController@destroy',
]);

# ------------- TRANSPORT -------------
$router->post('/transport', [
  'middleware' => ['auth'],
  'uses' => 'TransportController@store',
]);
$router->get('/transport/{uuid}', [
  'uses' => 'TransportController@show',
]);
$router->put('/transport/{uuid}', [
  'middleware' => ['auth'],
  'uses' => 'TransportController@update',
]);
$router->delete('/transport/{uuid}', [
  'middleware' => ['auth'],
  'uses' => 'TransportController@destroy',
]);

# ------------- TRIP -------------
$router->post('/trip', [
  'middleware' => ['auth'],
  'uses' => 'TripController@store',
]);
$router->get('/trip/{uuid}', [
  'uses' => 'TripController@show',
]);
$router->get('/trip', [
  'uses' => 'TripController@index',
]);
$router->put('/trip/{uuid}', [
  'middleware' => ['auth'],
  'uses' => 'TripController@update',
]);
$router->delete('/trip/{uuid}', [
  'middleware' => ['auth'],
  'uses' => 'TripController@destroy',
]);