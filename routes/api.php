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
    Route::put('/{question}/answers/{answer}', 'QuestionController@best_answer')->name('best_answer');
});
Route::get('/search/{content}', 'QuestionController@search')->name('questions.search');
Route::get('/questions/{question_id}/show', 'QuestionController@show')->name('questions.show');
Route::resource('/questions', 'QuestionController')->only(['store', 'update', 'destroy', 'edit']);

Route::resource('/answers', 'AnswerController', ['except' => ['index', 'show', 'create', 'store']])->middleware('auth');
Route::prefix('answers')->name('answers.')->group(function () {
    Route::put('/question/{question_id}', 'AnswerController@store')->name('store')->middleware('auth');
    Route::put('/{answer}/comment', 'AnswerController@comment')->name('comment')->middleware('auth');
    Route::delete('/comment/{comment}', 'AnswerController@uncomment')->name('uncomment')->middleware('auth');
});

Route::prefix('users')->name('users.')->group(function () {
    Route::get('/{name}', 'UserController@show')->name('show');
    Route::get('/{name}/answers', 'UserController@answers')->name('answers');
    Route::get('/{name}/questions', 'UserController@questions')->name('questions');
    Route::get('/{name}/likes', 'UserController@likes')->name('likes');
    Route::get('/{name}/followings', 'UserController@followings')->name('followings');
    Route::get('/{name}/followers', 'UserController@followers')->name('followers');
    Route::middleware('auth')->group(function () {
        Route::put('/{name}/follow', 'UserController@follow')->name('follow');
        Route::delete('/{name}/follow', 'UserController@unfollow')->name('unfollow');
    });
});

