<?php



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/add/product/view', 'ProductController@addproductview');
Route::post('/add/product/insert', 'ProductController@addproductinsert');
Route::get('/delete/product/{product_id}', 'ProductController@deleteproduct');
Route::get('/edit/product/{product_id}', 'ProductController@editproduct');
Route::post('/edit/product/insert', 'ProductController@editproductinsert');
Route::get('/restore/product/{product_id}', 'ProductController@restoreproduct');
Route::get('/forcedelete/product/{product_id}', 'ProductController@forcedeleteproduct');
Route::get('/add/category/view', 'CategoryController@categoryview');
Route::post('/add/category/insert', 'CategoryController@categoryinsert');
Route::get('contact/message/view', 'HomeController@contactmessageview');
Route::get('change/menu/status/{category_id}', 'HomeController@changemenustatus');

//Front end routes
Route::get('contact', 'FrontendController@contact');
Route::post('/contact/insert', 'FrontendController@contactinsert');
Route::get('about', 'FrontendController@about');
Route::get('/', 'FrontendController@index');
Route::get('/product/details/{product_id}', 'FrontendController@productdetails');
Route::get('/products/by/category/{category_id}', 'FrontendController@productsbycategory');
Route::get('/add/to/cart/{product_id}', 'FrontendController@addtocart');
Route::get('/cart', 'FrontendController@cart');
Route::get('/delete/from/cart/{cart_id}', 'FrontendController@deletefromcart');
Route::get('/clear/cart', 'FrontendController@clearcart');
