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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', function () {
  return redirect('admin/login');
});

Route::group(['prefix' => 'admin','namespace'=>'Admin'], function () {

	 Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
  Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
  Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
  Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

  Route::get('/change-password', 'AdminController@changePassword')->name('change-password');
  Route::post('/changePasswordSubmit', 'AdminController@changePasswordSubmit')->name('changePasswordSubmit');

  Route::get('/edit-profile', 'AdminController@editProfile')->name('edit-profile');
  Route::put('/editProfileSubmit', 'AdminController@editProfileSubmit')->name('editProfileSubmit');

  // Admin section
  Route::resource('admins','AdminController');

});
