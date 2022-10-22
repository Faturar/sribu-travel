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

use Admin\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')
    ->name('home');

Route::get('/detail/{slug}', 'DetailController@index')
    ->name('detail');


// Checkout
Route::post('/checkout/{id}', 'CheckoutController@process')
    ->name('checkout_process')
    ->middleware(['auth', 'verified']);

Route::get('/checkout/{id}', 'CheckoutController@index')
    ->name('checkout')
    ->middleware(['auth', 'verified']);

Route::post('/checkout/create/{detail_id}', 'CheckoutController@create')
    ->name('checkout-create')
    ->middleware(['auth', 'verified']);

Route::get('/checkout/remove/{detail_id}', 'CheckoutController@remove')
    ->name('checkout-remove')
    ->middleware(['auth', 'verified']);

Route::get('/checkout/confirm/{id}', 'CheckoutController@success')
    ->name('checkout-success')
    ->middleware(['auth', 'verified']);
    


// Dashboard User 
Route::get('/profile/{id}', 'ProfileController@index')
    ->name('profile')
    ->middleware('auth');

Route::get('/profile/{id}/edit', 'ProfileController@edit')
    ->name('profile-edit')
    ->middleware('auth');


Route::put('/profile/{id}', 'ProfileController@update')
    ->name('profile-update')
    ->middleware('auth');

Route::put('/profile/{id}/change=password', 'ProfileController@updatePassword')
    ->name('profile-update-pass')
    ->middleware('auth');

// Order
Route::get('/order/{users_id}', 'OrderController@index')
    ->name('order')
    ->middleware('auth');

Route::get('/order/detail/{id}', 'OrderController@detail')
    ->name('order-detail')
    ->middleware('auth');

Route::put('/order/cancel/{id}', 'OrderController@cancel')
    ->name('order-cancel')
    ->middleware('auth');

Route::delete('/order/{id}', 'OrderController@destroy')
    ->name('order-delete')
    ->middleware('auth');



// Dashboard Admin
Route::prefix('dashboard')
    ->namespace('Admin')
    ->group(function () {
        Route::get('/', 'DashboardController@index')
            ->name('dashboard');
            // ->middleware('admin', 'super_admin');

        Route::middleware(['admin', 'super_admin'])->group(function () {
            Route::resource('travel-package', 'TravelPackageController');

            Route::resource('gallery', 'GalleryController');

            Route::resource('transaction', 'TransactionController');
        });

        Route::resource('user', 'UserController')
            ->middleware(['auth', 'super_admin']);
    });

    


Auth::routes(['verify' => true]);
