<?php
use Illuminate\Http\Request;

Route::post('/register', 'Auth\RegisterController@register')->name('register');
Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/user', fn() => Auth::user())->name('user');;
Route::get('/guest', 'Auth\LoginController@guestLogin')->name('login.guest');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/un_solve', 'HomeController@un_solve')->name('un_solve');

Route::resource('/questions', 'QuestionController')->only(['show']);
Route::resource('/questions', 'QuestionController')->only(['store', 'update']);
Route::prefix('questions')->name('questions.')->group(function () {
    Route::put('/{question}/like', 'QuestionController@like')->name('like')->middleware('auth');
    Route::delete('/{question}/like', 'QuestionController@unlike')->name('unlike')->middleware('auth');
    Route::put('/{question}/answers/{answer}', 'QuestionController@best_answer')->name('best_answer')->middleware('auth');
});
