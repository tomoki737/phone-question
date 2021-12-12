<?php

use Illuminate\Http\Request;
Route::get('/', 'HomeController@index');
Route::get('/un_solve', 'HomeController@un_solve');
Route::resource('/questions', 'QuestionController', ['except' => ['index', 'show', 'create', 'edit']]);
Route::resource('/questions', 'QuestionController')->only(['show']);
