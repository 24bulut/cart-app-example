<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/helper.php';
require __DIR__ . '/route.php';

Route::get('/','indexController');

Route::get('login','authController@loginForm');
Route::post('login','authController@login');

Route::get('logout','authController@logout');

Route::get('register','authController@registerForm');
Route::post('register','authController@register');


Route::get('basket','basketController@index');
Route::post('basket','basketController@addItem');
Route::post('basket/{id}','basketController@updateQuantity');
