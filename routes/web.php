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

Auth::routes();

//管理画面（認証不要）
Route::group(['prefix' => 'admin'], function() {
    Route::get('/', function(){ return redirect('admin/password'); });
    Route::get('login', 'Admin\Auth\LoginController@showLoginForm');
    Route::post('login', 'Admin\Auth\LoginController@login')-> name('admin.login');
});

//管理画面（認証必要）
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {
    Route::get('logout', 'Admin\Auth\LoginController@logout')-> name('admin.logout');
    Route::get('/', 'Admin\AdminsController@getIndex')-> name('admin.index');
    Route::get('userlist', 'Admin\UserManagementsController@getUserList')-> name('admin.userlist');
    Route::get('adminlist', 'Admin\UserManagementsController@getAdminList')-> name('admin.adminlist');
    Route::get('productlist', 'Admin\ProductManagementsController@getProductList')-> name('admin.productlist');
});

//ユーザー画面（認証必要）
Route::group(['middleware' => 'auth:user'], function(){
  Route::get('/logout', [
    'uses' => 'UsersController@getLogout',
    'as' => 'logout'
  ]);

  Route::get('checkout', [
    'uses' => 'ProductsController@getCheckout',
    'as' => 'shop.checkout'
  ]);

  Route::post('checkout', [
    'uses' => 'ProductsController@postCheckout',
    'as' => 'checkout'
  ]);

  Route::get('order', [
    'uses' => 'OrdersController@getOrderHistory',
    'as' => 'shop.order'
  ]);

  Route::get('/order/{tar_date}', 'OrdersController@changeDate')-> name('order.change-date');

  Route::get('/getDate', 'OrdersController@getDateList')-> name('order.getDate');
});

//ユーザー画面（認証不要）
Route::get('/', [
  'uses' => 'ProductsController@getIndex',
  'as' => 'shop.index'
]);

Route::get('/shop/detail/{id}', [
  'uses' => 'ProductsController@getProductDetail',
  'as' => 'shop.detail'
]);

Route::get('/{id}', [
  'uses' => 'ProductsController@getGenreChange',
  'as' => 'shop.genre-change'
]);

Route::get('shop/cart', [
  'uses' => 'CartsController@getCart',
  'as' => 'shop.cart'
]);

Route::get('/shop/add-cart/{id}', [
  'uses' => 'CartsController@getAddCart',
  'as' => 'shop.add-cart'
]);

Route::get('shop/cart-flash', [
  'uses' => 'CartsController@getCartFlash',
  'as' => 'shop.cart-flash'
]);

Route::get('/shop/add-history/{id}', [
  'uses' => 'ProductsController@getAddHistory',
  'as' => 'shop.add-history'
]);

Route::get('shop/history', [
  'uses' => 'ProductsController@getHistory',
  'as' => 'shop.history'
]);

Route::get('shop/delete-item/{id}', [
  'uses' => 'CartsController@getDeleteItem',
  'as' => 'shop.delete-item'
]);
