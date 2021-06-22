<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::post('/logout/{user}', 'Auth\LoginController@logout')->name('logout');

// Home
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/search', 'HomeController@show');
Route::post('/home', 'QuestionController@store');
Route::get('/home/{question}', 'QuestionController@show');
Route::patch('/home/{question}', 'QuestionController@update');
Route::delete('/home/{question}', 'QuestionController@destroy');
Route::patch('/home/thread/{question}', 'QuestionController@index');

// Answer
Route::get('/answer/{answer}', 'AnswerController@show');
Route::post('/answer', 'AnswerController@store');
Route::delete('/answer/{answer}', 'AnswerController@destroy');
Route::patch('/answer/{answer}','AnswerController@update');

// Reply
Route::post('/reply', 'ReplyController@store');
Route::delete('/reply/{reply}', 'ReplyController@destroy');
Route::patch('/reply/{reply}','ReplyController@update');

// Welcome
Route::get('/', 'WelcomeController@index')->name('welcome');
Route::get('/search', 'WelcomeController@show');

// Thread No Login
Route::get('/thread_no_login/{question}', 'ThreadController@show');

// My Profile
Route::get('/myprofile/{user}', 'MyprofileController@show');

// Other Profile
Route::get('/otherprofile/{user}', 'OtherProfileController@show');
Route::get('/otherprofile_no_login/{user}', 'OtherProfileController@display');

// Settings Profile
Route::get('/settings/{user}', 'SettingsProfileController@show');
Route::patch('/settingsProfile/{user}','SettingsProfileController@update');

// Settings Password
Route::patch('/settingsPassword/{user}','SettingsPasswordController@update');

//Settings Photo
Route::post('/settingsPhoto', 'SettingsPhotoController@update');