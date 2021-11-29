<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/users', 'UserController@index')->name('users.index');
Route::resource('/questions', 'QuestionController', ['except' => ['index', 'show']])->middleware('auth');
Route::resource('/questions', 'QuestionController')->only(['show']);
Route::prefix('questions')->name('questions.')->group(function () {
    Route::put('/{question}/like', 'QuestionController@like')->name('like')->middleware('auth');
    Route::delete('/{question}/like', 'QuestionController@unlike')->name('unlike')->middleware('auth');
    Route::put('/{question}/answers/{answer}', 'QuestionController@best_answer')->name('best_answer')->middleware('auth');
});
Route::resource('/answers', 'AnswerController', ['except' => ['index', 'show', 'create', 'store']])->middleware('auth');
Route::prefix('answers')->name('answers.')->group(function () {
    Route::put('question/{question}', 'AnswerController@store')->name('store')->middleware('auth');
    Route::put('{answer}/comment', 'AnswerController@comment')->name('comment')->middleware('auth');
    Route::delete('comment/{comment}/comment', 'AnswerController@uncomment')->name('uncomment')->middleware('auth');
});
