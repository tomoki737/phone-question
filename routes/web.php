<?php

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::resource('/questions', 'QuestionController', ['except' => ['index']])->middleware('auth');;
