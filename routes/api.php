<?php
use Illuminate\Http\Request;

Route::post('/register', 'Auth\RegisterController@register')->name('register');
Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/user', fn() => Auth::user())->name('user');;
Route::get('/guest', 'Auth\LoginController@guestLogin');
Route::get('/', 'HomeController@index')->name('homep');
Route::get('/un_solve', 'HomeController@un_solve');
Route::resource('/questions', 'QuestionController')->only(['show']);
Route::resource('/questions', 'QuestionController', ['except' => ['index', 'show', 'create', 'edit']])->middleware('auth');
