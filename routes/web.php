<?php

use Symfony\Component\HttpFoundation\Session\Session;

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
    return view('welcome');
});

Route::get('session', function(){
    return Session::all();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/teachers', 'TeachersController');

Route::resource('/classrooms', 'ClassroomsController');

Route::resource('/students', 'StudentsController');

Route::get('/generatePDF','PDFController@generatePDF');
