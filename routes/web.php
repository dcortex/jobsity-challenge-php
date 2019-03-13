<?php

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

Route::get('/', 'SiteController@index')->name('home');
Route::get('/authors/{id}', 'SiteController@author')->name('site.author');
Route::get('/authors/tweets/{userId}', 'SiteController@tweets')->name('site.author.tweets');
Route::post('/authors/tweet/{tweetId}', 'SiteController@tweetUpdate')->name('site.author.tweetUpdate');

Route::resource('entries', 'EntryController');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::patch('/profile', 'ProfileController@update')->name('profile.update');
