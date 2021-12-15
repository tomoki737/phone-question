<?php
use Illuminate\Http\Request;

Route::post('/register', 'RegisterController@register')->name('register');
Route::post('/login', 'LoginController@login')->name('login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/isLogin', 'UserController@isLogin');
Route::get('/guest', 'Auth\LoginController@guestLogin');
Route::get('/', 'HomeController@index');
Route::get('/un_solve', 'HomeController@un_solve');
Route::resource('/questions', 'QuestionController')->only(['show']);
Route::resource('/questions', 'QuestionController', ['except' => ['index', 'show', 'create', 'edit']])->middleware('auth');
