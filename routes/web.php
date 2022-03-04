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
    return view('Home');
});

Route::view('/Home', 'home')->name('aHome');

Route::get('/error', function () { {return view('error');}})->name('aMostrarError');

Route::get('/logout', 'Auth\LoginController@logout')->name('login.aShowLogout');
 
Auth::routes();

