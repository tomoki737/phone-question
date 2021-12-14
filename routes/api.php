<?php

Route::get('/', 'HomeController@index');
Route::get('/un_solve', 'HomeController@un_solve');
Route::get('/isLogin', 'UserController@isLogin');
Route::resource('/questions', 'QuestionController')->only(['show']);
Route::resource('/questions', 'QuestionController', ['except' => ['index', 'show', 'create', 'edit']])->middleware('auth');
