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

Route::get('/{hash}', 'HomeController@open_link')->name('open_link');
Route::get('/', function () {   return view('welcome'); });

Route::get('ajax/link/generate', 'HomeController@ajax_generate_link')->name('ajax_generate_link');
