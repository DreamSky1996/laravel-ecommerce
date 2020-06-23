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

//Route::get('/', function () {
//    return view('welcome');
//});

View::share('my_constant',['es' => 'warning', 'en' => 'warning']);

Route::get('/', 'WelcomeController@index')->name('welcome');
Route::get('/productDetail', 'WelcomeController@productDetail');
Route::post('productFilter', 'WelcomeController@productFilter');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//create HTTP POST verb route that adds items to the cart
Route::post('/cart', 'Front@cart');
Route::get('/cart', 'Front@cart');
Route::get('/Cart','Front@CartAgain');

// stripe...
Route::get('/stripe', 'Front@stripe');
Route::post('/stripe', 'Front@stripePost')->name('stripe.post');

// checkout...
Route::get('/checkout', 'Front@checkout');
Route::post('/checkContinue', 'Front@checkoutContinue');



//backend

Route::group(['prefix'=>'admin'], function(){
    Route::get('/', 'HomeController@dashboard');
    Route::get('order_info','HomeController@order_info');
    Route::post('fetch_data', 'HomeController@fetch_data');


    Route::get('orders', 'HomeController@orders')->name('orders');
    Route::get('orderInfo', 'HomeController@orderInfo');
    Route::post('order_data', 'HomeController@order_data');

    Route::get('add-user', 'HomeController@addUser')->name('add-user');
    Route::post('add-user', 'HomeController@saveUser');

    Route::get('employee', 'HomeController@employeeShow')->name('employee');

    Route::get('product', 'ProductController@index')->name('product-create');
    Route::post('product', 'ProductController@store');
    Route::get('product-manage', 'ProductController@show')->name('product-manage');
    Route::get('updateProduct', 'ProductController@updateProduct');
    Route::get('ProductSale', 'ProductController@ProductSale');
    Route::post('saveUpdatedProduct', 'ProductController@saveUpdatedProduct')->name('saveUpdatedProduct');


    Route::get('category', 'CategoryController@index')->name('category');
    Route::post('crateCategory', 'CategoryController@create')->name('crateCategory');
    Route::post('updateCategory', 'CategoryController@updateCategory');
    Route::post('saveUpdatedCategory', 'CategoryController@saveUpdatedCategory')->name('saveUpdatedCategory');
    Route::post('deleteCategory', 'CategoryController@deleteCategory');


    Route::get('customer-info', 'HomeController@customerInfo')->name('customer-info');
    Route::get('customer-reset', 'HomeController@customerReset')->name('customer-reset');
    Route::get('customerMoreInfo', 'HomeController@customerMoreInfo')->name('customerMoreInfo');
    Route::get('customerEdit', 'HomeController@customerEdit')->name('customerEdit');
    Route::post('customerUpdate', 'HomeController@customerUpdate')->name('customerUpdate');


    //edit profile
    Route::get('profile', 'HomeController@myProfile')->name('profile');
    Route::post('profile', 'HomeController@updateProfile');

    //edit user
    Route::get('employeeMoreInfo', 'HomeController@employeeMoreInfo');
    Route::post('saveUpdatedUser', 'HomeController@saveUpdatedUser')->name('saveUpdatedUser');


    Route::get('adminPassword', 'HomeController@adminPassword')->name('adminPassword');
    Route::post('resetAdminPassword', 'HomeController@resetAdminPassword')->name('resetAdminPassword');
});

Route::get('/config-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});
