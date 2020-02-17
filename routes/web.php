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

Route::get('/', function () {
    return view('aapps.index');
})->name('home');



Route::get('events', 'EventsController@index')->name('events.index');
Route::post('events', 'EventsController@addEvent')->name('events.add');
Route::get('events/load', 'EventsController@initialEvents')->name('events.load');

