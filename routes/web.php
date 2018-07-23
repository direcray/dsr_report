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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/customers', 'CustomerController@index');
Route::get('/view/customer/{id}', 'CustomerController@view');
Route::get('/employees', 'EmployeeController@index');
Route::get('/view/employee/{id}', 'EmployeeController@view');
Route::get('/view/dsr/{id}', 'EmployeeController@dsr_report');
Route::get('/{id}', 'EmployeeController@dsr_report');
Route::view('/blank', 'blank');
Route::view('/dashboard', 'dashboard');
/*
Route::get('/media', 'FileController@index');
Route::get('/', 'FileController@index');
Route::get('/search/{tag}', 'FileController@search');
*/
