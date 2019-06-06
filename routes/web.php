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

//スケジュール削除のルーティング
Route::delete('/posts/{scheduleId}', 'SchedulesController@destroy');

//スケジュールの詳細画面表示のルーティング
Route::get('/{scheduleId}', 'SchedulesController@show');

//スケジュールの編集のルーティング
Route::get('/{scheduleId}/edit', 'SchedulesController@edit');
Route::patch('/{scheduleId}', 'SchedulesController@update');

//コメントの作成のためのルーティング
Route::post('/post/comment/{scheduleId}', 'CommentController@store');

//出欠情報編集のためのルーティング
Route::get('/{scheduleId}/availability/edit', 'AvailabilityEditController@edit');
Route::patch('/attend/{scheduleId}', 'AvailabilityEditController@update');
