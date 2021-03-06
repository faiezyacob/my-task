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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/tasks', 'TaskController@index');
Route::get('/tasks/related', 'TaskController@related');
Route::get('/tasks/form', 'TaskController@showForm');
Route::get('/tasks/edit/{id}', 'TaskController@editForm');
Route::post('tasks/store', 'TaskController@store');
Route::delete('/tasks/delete/{id}', 'TaskController@destroy');