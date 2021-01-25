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

Route::get('/', function () {
    return redirect()->route('admin.login');
    //return view('welcome');
});




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');




Route::namespace("Admin")->prefix('admin')->group(function () {

    Route::get('/dashboard', 'AdminHomeController@index')->name('admin.home');

    Route::resource('permissions','PermissionController');
    Route::resource('roles','RoleController');




    Route::resource('users','UserController');

    Route::resource('badges','AdminBadgeController');

    Route::resource('ads','AdminAdController');

    Route::namespace('Auth')->group(function () {
        Route::get('/login', 'AdminLoginController@showLoginForm')->name('admin.login');
        Route::post('/login', 'AdminLoginController@login');
        Route::post('/logout', 'AdminLoginController@logout')->name('admin.logout');
    });


});
