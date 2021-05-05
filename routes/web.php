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