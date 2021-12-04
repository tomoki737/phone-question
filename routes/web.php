<?php
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/un_solve', 'HomeController@un_solve')->name('un_solve');
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
    Route::put('/question/{question}', 'AnswerController@store')->name('store')->middleware('auth');
    Route::put('/{answer}/comment', 'AnswerController@comment')->name('comment')->middleware('auth');
    Route::delete('/comment/{comment}', 'AnswerController@uncomment')->name('uncomment')->middleware('auth');
});

Route::prefix('users')->name('users.')->group(function () {
    Route::get('/{name}', 'UserController@show')->name('show');
    Route::get('/{name}/answers', 'UserController@answers')->name('answers');
    Route::get('/{name}/likes', 'UserController@likes')->name('likes');
    Route::get('/{name}/followings', 'UserController@followings')->name('followings');
    Route::get('/{name}/followers', 'UserController@followers')->name('followers');
    Route::middleware('auth')->group(function () {
        Route::put('/{name}/follow', 'UserController@follow')->name('follow');
        Route::delete('/{name}/follow', 'UserController@unfollow')->name('unfollow');
    });
});

