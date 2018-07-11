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

Route::get('/', 'PagesController@index');
Route::get('/about','PagesController@about');
Route::resource('/join-us','JobsController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/apply/{job_id}',['as'=>'apply','uses'=>'Jobs_UsersController@create']);


Route::resource('/applications','Jobs_UsersController');


Route::get('applications/create', function() {
	return redirect('/join-us');
});

Route::get('/sandbox','HomeController@sandbox');

Route::resource('/resume', 'ResumesController');

Route::get('resume',array('before'=>'auth'));

Route::get('resume/create', function() {
	return redirect('/home');
});

Route::get('/resume', function() {
	return redirect('/home');
});

Route::get('/download', 'ResumesController@downloadResume');


