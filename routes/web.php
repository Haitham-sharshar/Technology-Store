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
        /*
         * Admin Routes
         */
Route::prefix('admin')->group(function(){
 Route::middleware('auth:admin')->group(function(){
     //Dashbord Route
     Route::get('/','DashboardController@index');

// Product Route
     Route::resource('/products','ProductController');
// order Route
     Route::resource('/orders','OrderController');
     Route::get('/confirm/{id}','OrderController@confirm')->name('order.confirm');
     Route::get('/pending/{id}','OrderController@pending')->name('order.pending');

// user Route
     Route::resource('/users','UsersController');

 });
    //Admin login
    Route::get('/login','AdminUserController@index')->name('login');
    Route::post('/login','AdminUserController@store');
    //logout
    Route::get('/logout','AdminUserController@logout');
});
 /*
  * front Routes
  */
Route::get('/','Front\HomeController@index');
//User Registration
Route::get('/user/register','Front\RegistrationController@index');
Route::post('/user/register','Front\RegistrationController@store');

//user Login
Route::get('user/login','Front\LoginController@index');
Route::post('user/login','Front\LoginController@store');

//user logout
Route::get('user/logout','Front\LoginController@logout');
// User Profile
Route::get('user/profile','Front\UserProfileController@index');
Route::put('user/edit/{id}','Front\UserProfileController@update');

//Cart
Route::get('/cart','Front\CartController@index');
Route::post('/cart','Front\CartController@store')->name('cart');
Route::delete('/cart/remove/{id}','Front\CartController@destroy')->name('cart.destroy');
Route::post('/cart/saveLater/{id}','Front\CartController@saveLater')->name('cart.saveLater');
Route::patch('/cart/update/{id}','Front\CartController@update')->name('cart.update');


//save for later

Route::delete('/saveLater/destroy/{id}','Front\saveLaterController@destroy')->name('saveLater.destroy');
Route::post('/cart/moveToCart/{id}','Front\saveLaterController@moveToCart')->name('moveToCart');

//check out
Route::get('/checkout','Front\CheckoutController@index');
Route::post('/checkout','Front\CheckoutController@store')->name('checkout');





