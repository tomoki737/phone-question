<?php

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::resource('/questions', 'QuestionController', ['except' => ['index','show']])->middleware('auth');
Route::resource('/questions', 'QuestionController')->only(['show']);
Route::get('/users', 'UserController@index')->name('users.index');
