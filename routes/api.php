<?php

use Illuminate\Http\Request;

Route::group(['middleware' => 'auth:api'], function () {

////////////////////////////////  UserController   ///////////////////////////////////
    Route::post('/editUserProfile', 'API\v1\UserController@editUserProfile');
    Route::post('/changePassword', 'API\v1\UserController@changePassword');
    Route::get('/myProfile', 'API\v1\UserController@myProfile');
    Route::get('/logout', 'API\v1\UserController@logout');
    Route::post('/resetPassword', 'API\v1\UserController@resetPassword');
    Route::post('updateMyLanguage', 'API\v1\UserController@updateMyLanguage');
    Route::get('deleteMyAccount', 'API\v1\UserController@deleteMyAccount');
    Route::get('changeNotificationStatus', 'API\v1\UserController@changeNotificationStatus');



///////////////////////////////// Cart Controller /////////////////////////////////////
    Route::get('myOrders', 'API\v1\CartController@myOrders');

////////////////////////////////  App Controller /////////////////////////////////////
    Route::get('deleteMySearches', 'API\v1\AppController@deleteMySearches');

});

 ////////////////////////////////  AppController   ///////////////////////////////////

Route::post('home', 'API\v1\AppController@home');
Route::get('restaurantDetails/{id}', 'API\v1\AppController@restaurantDetails');
Route::get('restaurantMeals/{id}', 'API\v1\AppController@restaurantMeals');
Route::get('mealDetails/{id}', 'API\v1\AppController@mealDetails');

Route::get('getSetting', 'API\v1\AppController@getSetting');
Route::get('pages/{id}', 'API\v1\AppController@pages');
Route::post('contactUs', 'API\v1\AppController@contactUs');
Route::post('JoinUs', 'API\v1\AppController@JoinUs');
Route::get('filter', 'API\v1\AppController@filter');
Route::get('search', 'API\v1\AppController@search');
Route::get('getMySearches', 'API\v1\AppController@getMySearches');
Route::get('testPay', 'API\AppController@testPay');


////////////////////////////////  UserController   ///////////////////////////////////

Route::post('/login', 'API\v1\UserController@login');
Route::post('/signUp', 'API\v1\UserController@signUp');
Route::post('/forgotPassword', 'API\v1\UserController@forgotPassword');
Route::get('myNotifications', 'API\v1\UserController@myNotifications');


////////////////////////////////  CartController   ///////////////////////////////////
Route::post('/addToCart', 'API\v1\CartController@addToCart');
Route::get('/myCart', 'API\v1\CartController@myCart');
Route::get('/changeQuantity/{id}', 'API\v1\CartController@changeQuantity');
Route::get('/removeFromCart/{id}', 'API\v1\CartController@removeFromCart');
Route::get('/startNewOrder', 'API\v1\CartController@startNewOrder');
Route::post('checkPromoCode', 'API\v1\CartController@checkPromoCode');
Route::post('storeOrder', 'API\v1\CartController@storeOrder');
Route::get('orderDetails/{id}', 'API\v1\CartController@orderDetails');
Route::get('/reOrder', 'API\v1\CartController@reOrder')->name('reOrder');





