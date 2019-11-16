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
Route::get('/threads','ThreadController@index');
Route::get('/threads/create','ThreadController@create');
Route::post('/threads','ThreadController@store');
Route::get('/threads/{channel}/{id}','ThreadController@show');
Route::post('/threads/{channel}/{id}/replies','ReplyController@store');