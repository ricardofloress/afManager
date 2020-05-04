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

use App\Http\Controllers\HomeController;



//Frontend Site Route
Route::get('/', 'HomeController@index');


//Show Category and Manufacturer Routes
Route::get('/product-by-category/{category_id}', 'HomeController@show_product_by_category');
Route::get('/product-by-manufacturer/{manufacturer_id}', 'HomeController@show_product_by_manufacturer');
Route::get('/view-product/{product_id}', 'HomeController@product_details_by_id');


//Cart Routes
Route::post('/add-to-cart', 'CartController@add_to_cart');
Route::get('/delete-from-cart/{rowId}', 'CartController@delete_from_cart');
Route::post('/update-cart', 'CartController@update_cart');
Route::get('/show-cart', 'CartController@show_cart');


//Checkout Routes
Route::get('/checkout', 'CheckoutController@index');
Route::post('/save-shipping-details', 'CheckoutController@save_shipping_details');
Route::get('/payment', 'CheckoutController@payment');
Route::post('/save-payment', 'CheckoutController@save_payment');
Route::get('/order-complete', 'CheckoutController@order_complete');


//User Routes
Route::get('/login', 'UserController@index');
Route::get('/logout', 'UserController@logout');
Route::post('/user-registration', 'UserController@user_registration');
Route::post('/user-login', 'UserController@login');


//Backend Routes
Route::get('/admin-logout', 'SuperAdminController@logout');
Route::get('/admin', 'AdminController@index')->name('admin');
Route::get('/dashboard', 'HomeController@index');
Route::get('/all-order', 'OrderController@all_order');
Route::get('/order-detail/{order_id}', 'OrderController@order_detail');
Route::post('/update-order/{order_id}', 'OrderController@update_order');
Route::get('/delete-order/{order_id}', 'OrderController@delete_order');


//Category Routes
Route::get('/add-category', 'CategoryController@index');
Route::get('/all-category', 'CategoryController@all_category');
Route::post('/save-category', 'CategoryController@save_category');
Route::get('/edit-category/{category_id}', 'CategoryController@edit_category');
Route::post('/update-category/{category_id}', 'CategoryController@update_category');
Route::get('/delete-category/{category_id}', 'CategoryController@delete_category');


//Store Routes
Route::get('/add-store', 'StoreController@index');
Route::get('/all-store', 'StoreController@all_store');
Route::post('/save-store', 'StoreController@save_store');
Route::get('/edit-store/{store_id}', 'StoreController@edit_store');
Route::post('/update-store/{store_id}', 'StoreController@update_store');
Route::get('/delete-store/{store_id}', 'StoreController@delete_store');


//Manufacturer Routes
Route::get('/add-manufacturer', 'ManufacturerController@index');
Route::get('/all-manufacturer', 'ManufacturerController@all_manufacturer');
Route::post('/save-manufacturer', 'ManufacturerController@save_manufacturer');
Route::get('/edit-manufacturer/{manufacturer_id}', 'ManufacturerController@edit_manufacturer');
Route::post('/update-manufacturer/{manufacturer_id}', 'ManufacturerController@update_manufacturer');
Route::get('/delete-manufacturer/{manufacturer_id}', 'ManufacturerController@delete_manufacturer');
Route::any('/search-manufacturer', 'ManufacturerController@search_manufacturer');



//Product Routes
Route::get('/add-product', 'ProductController@index');
Route::get('/all-product', 'ProductController@all_product');
Route::post('/save-product', 'ProductController@save_product');
Route::get('/edit-product/{product_id}', 'ProductController@edit_product');
Route::post('/update-product/{product_id}', 'ProductController@update_product');
Route::get('/delete-product/{product_id}', 'ProductController@delete_product');
Route::any('/search-product', 'ProductController@search_product');



//Slider Routes
Route::get('/add-slider', 'SliderController@index');
Route::get('/all-slider', 'SliderController@all_slider');
Route::post('/save-slider', 'SliderController@save_slider');
Route::get('/edit-slider/{slider_id}', 'SliderController@edit_slider');
Route::post('/update-slider/{slider_id}', 'SliderController@update_slider');
Route::get('/delete-slider/{slider_id}', 'SliderController@delete_slider');


//Client Routes
Route::get('/add-client', 'ClientController@index');
Route::get('/all-client', 'ClientController@all_client');
Route::post('/save-client', 'ClientController@save_client');
Route::get('/edit-client/{client_id}', 'ClientController@edit_client');
Route::post('/update-client/{client_id}', 'ClientController@update_client');
Route::get('/delete-client-detail/{client_detail_id}', 'ClientController@delete_client_detail');
Route::post('/add-client-detail', 'ClientController@save_client_detail');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
