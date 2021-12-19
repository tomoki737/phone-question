<?php
use Illuminate\Http\Request;

Route::post('/register', 'Auth\RegisterController@register')->name('register');
Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/user', fn() => Auth::user())->name('user');;
Route::get('/guest', 'Auth\LoginController@guestLogin')->name('login.guest');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/un_solve', 'HomeController@un_solve')->name('un_solve');

Route::prefix('questions')->name('questions.')->group(function () {
    Route::put('/{question}/like', 'QuestionController@like')->name('like');
    Route::delete('/{question}/unlike', 'QuestionController@unlike')->name('unlike');
    // Route::put('/{question}/answers/{answer}', 'QuestionController@best_answer')->name('best_answer');
});
Route::get('/questions/{question_id}/show', 'QuestionController@show')->name('questions.show');
Route::resource('/questions', 'QuestionController')->only(['store', 'update', 'destroy']);

Route::resource('/answers', 'AnswerController', ['except' => ['index', 'show', 'create', 'store']])->middleware('auth');
Route::prefix('answers')->name('answers.')->group(function () {
    Route::put('/question/{question_id}', 'AnswerController@store')->name('store')->middleware('auth');
    Route::put('/{answer}/comment', 'AnswerController@comment')->name('comment')->middleware('auth');
    Route::delete('/comment/{comment}', 'AnswerController@uncomment')->name('uncomment')->middleware('auth');
});
