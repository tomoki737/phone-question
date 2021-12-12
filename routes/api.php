<?php

use Illuminate\Http\Request;
Route::get('/', 'HomeController@index');
Route::get('/un_solve', 'HomeController@un_solve');
Route::resource('/questions', 'QuestionController')->only(['show']);
// Route::post('/register', 'Api\Auth\RegisterController@register');
Route::resource('/questions', 'QuestionController', ['except' => ['index', 'show', 'create', 'edit']])->middleware('auth');
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/me', 'AuthController@me');
    Route::post('/logout', 'Api\Auth\LoginController@logout');
});
