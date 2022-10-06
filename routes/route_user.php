<?php
namespace App\Http\Controllers\Customer;
use Illuminate\Support\Facades\Route;

//Frontend
Route::group(['prefix' => ''], function(){
	Route::get('/', [HomeController::class, 'index'])->name('home.index');
    // Product
    Route::group(['prefix' => 'products'], function(){
        Route::get('chi-tiet-san-pham/{slug}', [ProductController::class, 'getProductDetail'])->name('products.show');
        Route::get('search', [ProductController::class, 'searchProduct'])->name('searchProduct');
        Route::get('/livesearch',[ProductController::class, 'liveSearch'])->name('products.livesearch');
    });

// Product category

    Route::get('catalog/{slug}/{id}', [HomeController::class, 'getProductCategory'])->name('product.category');


//Route::get('cart', [CartController::class, 'index'])->name('home.cart');
// Login
Route::get('login-customer', [CustomerController::class, 'getLoginCustomer'])->name('customer.login');
Route::post('login-customer', [CustomerController::class, 'postLoginCustomer'])->name('customer.postLogin');
Route::get('register-customer', [CustomerController::class, 'getRegister'])->name('customer.signUp');
Route::post('register-customer', [CustomerController::class, 'registerCustomer'])->name('postSignUp');
Route::get('/verification-email-customer', [CustomerController::class, 'getVerificationEmail'])->name('getVerificationEmail');
Route::post('/verification-email-customer', [CustomerController::class, 'verificationEmailCustomer'])->name('verificationEmail');
Route::get('logout-customer', [CustomerController::class, 'customerLogout'])->name('customer.logout');

//Profile
    Route::group(['prefix' => 'profile'], function(){
        Route::get('/', [CustomerController::class, 'getProfile'])->name('customer.profile');
        Route::post('updateProfile', [CustomerController::class, 'updateUserInfo'])->name('customer.updateInfo');
        Route::post('change-password', [CustomerController::class, 'changePassword'])->name('customer.changPassword');
    });


//Add to Cart\
    Route::group(['prefix' => 'cart'], function(){
        Route::get('/', [CartController::class, 'showCart'])->name('showCart');
        Route::get('/add-to-cart/{id}', [CartController::class, 'addProductCart'])->name('addToCart');
        Route::post('/update-cart/{id}/{quanty}', [CartController::class, 'updateCart'])->name('updateCart');
        Route::get('/delete-cart/{id}', [CartController::class, 'deleteCart'])->name('deleteCart');
    });
    Route::post('/check-coupon', [CartController::class, 'CheckCoupon']);
//    Checkout

    Route::get('checkout', [CheckoutController::class, 'index'])->name('getCheckout');
    Route::post('checkout/store', [CheckoutController::class, 'postCheckout'])->name('postCheckout');
    Route::get('/delete-coupon-cart', [CheckoutController::class, 'DeleteCoupon']);


//    Contact

//    Review

//    Order
//    Route::get('/order_history',[OrderTrackingController::class, 'orderHistory'])->name('order.history');

    Route::get('/order_history/cancel-order/{orderCode}',[HomeController::class, 'cancelOrder'] )->name('order.history.cancel');


//    Contact
    Route::get('contact', [HomeController::class, 'getContact'])->name('customer.contact');

//    Blog
    Route::get('blog', [HomeController::class, 'postPage'])->name('home.blog');
    Route::get('blog/{slug}', [HomeController::class, 'showPost'])->name('home.showBlog');

//    Comment
    Route::post('post-comment-customer', [CommentController::class, 'PostCommentCustomer'])->name('customer.comment');
    Route::post('/load-comment',[CommentController::class, 'LoadComment']);


});
