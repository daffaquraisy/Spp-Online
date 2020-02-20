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
    return view('auth.login');
});

Route::match(['get', 'post'], '/register', function () {
    return redirect('/login');
})->name('register');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::resource('/users', 'UserController');

Route::resource('/classrooms', 'ClassroomController');

Route::resource('/spps', 'SppController');

Route::get('/ajax/classrooms/search_name', 'StudentController@ajaxSearchClassName');
Route::get('/ajax/classrooms/kompetensi_name', 'StudentController@ajaxSearchKomptensiName');
Route::get('/ajax/spps/search_tahun', 'StudentController@ajaxSearchTahun');
Route::get('/ajax/spps/search_nominal', 'StudentController@ajaxSearchNominal');
Route::resource('/students', 'StudentController');

Route::get('/ajax/orders/search_nama', 'OrderController@ajaxSearchName');
Route::resource('/orders', 'OrderController');
