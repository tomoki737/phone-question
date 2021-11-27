<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::resource('/questions', 'QuestionController', ['except' => ['index', 'show']])->middleware('auth');
Route::resource('/questions', 'QuestionController')->only(['show']);
Route::get('/users', 'UserController@index')->name('users.index');
Route::resource('/answers', 'AnswerController', ['except' => ['index', 'show', 'create', 'store']])->middleware('auth');
Route::put('/{question}/answers', 'AnswerController@store')->name('answers.store')->middleware('auth');
Route::prefix('questions')->name('questions.')->group(function () {
    Route::put('/{question}/like', 'QuestionController@like')->name('like')->middleware('auth');
    Route::delete('/{question}/like', 'QuestionController@unlike')->name('unlike')->middleware('auth');
});
