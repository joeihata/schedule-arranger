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

//Authenticationのためのルート設定
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
//新規スケジュール作成のためのルート設定
Route::get('/new', 'SchedulesController@create');
Route::post('post', 'SchedulesController@store');
Route::delete('/posts/{scheduleId}', 'SchedulesController@destroy');
//記事の詳細画面のルーティング
Route::get('/{scheduleId}', 'SchedulesController@show');
//記事の編集画面へのルーティング
Route::get('/{scheduleId}/edit', 'SchedulesController@edit');
Route::patch('/{scheduleId}', 'SchedulesController@update');