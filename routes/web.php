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

Route::get('/', 'HomeController@index')->name('photos.index');
Route::get('contact/', 'ContactController@index')->name('videos.index');

Route::delete('/photos/{id}', 'PhotoController@destroy')->name('photos.destroy');
Route::delete('/videos/{id}', 'VideoController@destroy')->name('videos.destroy');

Route::resource('photos', 'App\Http\Controllers\PhotoController');
Route::resource('videos', 'App\Http\Controllers\VideoController');