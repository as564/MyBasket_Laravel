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

/* Route::get('/', function () {
    return view('welcome');
}); */

//dashboard

/* Route::get('/', function () {
    return view('layouts.app');
}); */

Route::get('/register','RegistrationController@register');
Route::post('/register','RegistrationController@postRegister');

Route::get('/','AdminLoginController@login');
Route::post('/adminlogin','AdminLoginController@postLogin');
Route::post('/','AdminLoginController@logout');
Route::get('/adminregister','AdminRegistrationController@register');
Route::post('/adminregister','AdminRegistrationController@postRegister');

//Admin Forgot password
Route::get('/forgot-password','ForgotPasswordController@forgotPassword');
Route::post('/forgot-password','ForgotPasswordController@postForgotPassword');

//Admin Dashboard
Route::get('/admin-dashboard','AdminController@index')->middleware('admin');

//Admin Change password
Route::get('/resetpassword', array('as' => 'reset.password', 'uses' => 'PasswordController@edit'));
Route::post('/resetpasswordcomplete', array('as' => 'reset.password.complete', 'uses' => 'PasswordController@update'));

//Admin Forgot Password reset
Route::get('/reset/{email}/{resetCode}', 'ForgotPasswordController@resetPassword');
Route::post('/reset/{email}/{resetCode}', 'ForgotPasswordController@postResetPassword');

//Account Settings
//Route::get('/account-settings','AccountSettingsController@index');
Route::post('/account-settings','AccountSettingsController@store');
Route::post('/account-settings/{id}','AccountSettingsController@update');
Route::get('/account-settings/{id}/edit','AccountSettingsController@edit');



Route::get('/categories', 'CategoriesController@index' )->middleware('admin');
Route::post('/categories', 'CategoriesController@store')->middleware('admin');
Route::get('/categories/{id}/edit','CategoriesController@edit')->middleware('admin');
Route::post('/categories/{id}','CategoriesController@update')->middleware('admin');
Route::delete('/categories/{id}', 'CategoriesController@destroy')->middleware('admin');

Route::get('/products', 'ProductsController@index');
Route::post('/products', 'ProductsController@store');
Route::get('/products/{id}/edit','ProductsController@edit');
Route::post('/products/{id}','ProductsController@update');
Route::delete('/products/{id}', 'ProductsController@destroy');

Route::get('/user-dashboard', 'UsersController@index');
Route::get('/user-dashboard/{id}', 'UsersController@show');

Route::get('/login', function(){
    return view('user-dashboard.login');
});

Route::post('/login', [UsersController::class,'login']);

Route::get('/home', 'HomeController@index')->name('home');
