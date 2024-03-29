<?php
Route::get('/','TasksController@index');
Route::resource('tasks','TasksController');

//ユーザ登録のルータ
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

//ログイン認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

// ログイン認証を必要とするルーティンググループ、ユーザーモデルとタスクモデルにアクセスできるクションを指定する。
Route::group(['middleware' => 'auth'], function () {
    Route::resource('users', 'UsersController', ['only' => ['index', 'show']]);
    Route::resource('tasks', 'TasksController', ['only' => ['store', 'destroy']]);
});