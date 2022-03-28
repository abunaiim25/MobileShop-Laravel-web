<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Admin\FrontadminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\DashboardController;

use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\RatingController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\WishlistController;

use App\Http\Controllers\SslCommerzPaymentController;


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
Route::get('/', function () {
    return view('welcome');
});
*/

//languages
Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);
Route::get('/languageDemo', 'App\Http\Controllers\HomeController@languageDemo');


//3.1
Route::get('/',[FrontendController::class,'index']);
Route::get('category',[FrontendController::class,'category']);
Route::get('view-category/{slug}',[FrontendController::class,'viewcategory']);


//1
Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//4
Route::post('add-to-cart',[CartController::class, 'addToCart']);
Route::post('delete-cart-item',[CartController::class, 'deleteCart']);
Route::post('update-cart',[CartController::class, 'updateCart']);
//11
Route::get('load-cart-count',[CartController::class, 'cartcount']);
Route::get('load-wishlist-count',[WishlistController::class, 'wishlistcount']);



//10
Route::post('add-to-wishlist',[WishlistController::class, 'addwishlist']);
Route::post('delete-wishlist-item',[WishlistController::class, 'deletewishlist']);


Route::middleware(['auth'])->group(function (){

    Route::get('cart',[CartController::class, 'viewCart']);
     //5//cart--checkout--CheckoutController
    Route::get('checkout',[CheckoutController::class, 'index']);
    Route::post('place-order',[CheckoutController::class, 'placeorder']);

    //6 
    Route::get('my-orders',[UserController::class, 'index']);
    Route::get('view-order/{id}',[UserController::class, 'view']);

    //13
    Route::post('add-rating',[RatingController::class,'addrating']);
    //14
    Route::get('add-review/{product_slug}/userreview',[ReviewController::class, 'reviewadd']);
    Route::post('add-review',[ReviewController::class, 'reviewcreate']);
    Route::get('edit-review/{product_slug}/userreview',[ReviewController::class, 'editreview']);
    Route::put('update-review',[ReviewController::class, 'update']);

    //9
    Route::get('wishlist',[WishlistController::class, 'index']);

    //12
    Route::post('proceed-to-pay',[CheckoutController::class, 'razorpaycheck']);

    //3.2
    Route::get('category/{cate_slug}/{prod_slug}',[FrontendController::class,'productview']);


    //paymenyt
    Route::get('view-order-payment/{id}', [SslCommerzPaymentController::class,'view']);
});


//2
//add admin//link name in website
Route::middleware(['auth', 'isAdmin'])->group(function(){


    //admin dashboard
    Route::get('/dashboard', [FrontadminController::class,'index']);


    //admin category
    Route::get('categories', [CategoryController::class,'index']);
   //admin add category
    Route::get('add-category', [CategoryController::class,'add']);
    Route::post('insert-category', [CategoryController::class,'insert']);
    //edit category
    Route::get('edit-category/{id}', [CategoryController::class,'edit']);//avobe import CategoryController
    Route::put('update-category/{id}', [CategoryController::class,'update']);
    //delete category
    Route::get('delete-category/{id}', [CategoryController::class,'destroy']);



    //admin Product
    Route::get('products', [ProductController::class,'index']);//avobe import ProductController
    //admin add product
    Route::get('add-products', [ProductController::class,'add']);
    Route::post('insert-product', [ProductController::class,'insert']);
   //admin product-----previous
    Route::get('edit-product/{id}', [ProductController::class,'edit']);//avobe import CategoryController
    Route::put('update-product/{id}', [ProductController::class,'update']);
    Route::get('delete-product/{id}', [ProductController::class,'destroy']);

    //7
    Route::get('orders', [OrderController::class,'index']);
    Route::get('admin/view-order/{id}', [OrderController::class,'view']);
    Route::put('update-order/{id}', [OrderController::class,'updateorder']);
    Route::get('order-history', [OrderController::class,'orderhistory']);

     //8
     Route::get('users', [DashboardController::class,'users']);
     Route::get('view-user/{id}', [DashboardController::class,'viewuser']);


});



// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
