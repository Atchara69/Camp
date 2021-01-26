<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

Route::get('/products', "ProductController@index");
Route::get('/products/category/{id}', 'ProductController@findCategory');
Route::get('/products/details/{id}', 'ProductController@details');


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', function () {
    return redirect('/products');
});
Route::get('/register', 'RegisterController@index')->name('register');
Auth::routes();


Route::middleware(['auth', 'verifyIsAdmin'])->group(function () {
    // Category
    Route::get('admin/createCategory', 'Admin\CategoryController@index');
    Route::post('admin/createCategory', 'Admin\CategoryController@store');
    Route::get('admin/editCategory/{id}', 'Admin\CategoryController@edit');
    Route::post('admin/updateCategory/{id}', 'Admin\CategoryController@update');
    Route::get('admin/deleteCategory/{id}', 'Admin\CategoryController@delete');

    // Product
    Route::get('admin/createProduct', 'Admin\ProductController@create');
    Route::get('admin/dashboard', 'Admin\ProductController@index');
    Route::get('admin/editProduct/{id}', 'Admin\ProductController@edit');
    Route::get('admin/editProductImage/{id}', 'Admin\ProductController@editImage');
    Route::post('admin/createProduct', 'Admin\ProductController@store');
    Route::post('admin/updateProduct/{id}', 'Admin\ProductController@update');
    Route::post('admin/updateProductImage/{id}', 'Admin\ProductController@updateImage');
    Route::get('admin/deleteProduct/{id}', 'Admin\ProductController@delete');

    //order
    Route::get('admin/orders', 'Admin\OrderController@orderPanel');
    Route::get('admin/orders/detail/{id}', 'Admin\OrderController@showOrderDetail');

    //payments
    Route::get('admin/payments', 'Admin\PaymentController@paymentsPanel');

    //user
    Route::get('admin/users', 'Admin\UserController@showUsers');
});
Route::get('/products/addToCart/{id}', 'ProductController@addProductToCart');


Route::middleware(['auth'])->group(function () {
    Route::get('/products/cart', 'ProductController@showCart');
    Route::get('/products/cart/deleteFromCart/{id}', 'ProductController@deleteFromCart');
    Route::get('/products/cart/incrementCart/{id}', 'ProductController@incrementCart');
    Route::get('/products/cart/decrementCart/{id}', 'ProductController@decrementCart');
    Route::post('/products/addQuantityToCart', 'ProductController@addQuantityToCart');

    
});
//FrontEnd
// Route::middleware(['auth','verifyIsAdmin'])->group(function(){
// Add to Cart


//Create Orders
Route::get('/products/checkout', 'ProductController@checkout');
Route::post('/products/createOrder', 'ProductController@createOrder');
Route::get('/products/showPayment', 'ProductController@showPayment');

//payment
Route::get('/paymentreceipt/{paypalOrderID}/{payerID}', 'PaymentController@showPayment');



// });

Route::get('/products/priceRange', 'ProductController@searchProductPrice');
Route::get('/products/search', 'ProductController@searchProduct');
