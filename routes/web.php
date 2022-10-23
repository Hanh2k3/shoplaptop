<?php

use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use  App\Http\Controllers\CartController;
use  App\Http\Controllers\CheckoutController;
use  App\Http\Controllers\CustomerController;
use  App\Http\Controllers\OrderController;
use  App\Http\Controllers\t;
use  App\Http\Controllers\LoginController;
use  App\Http\Controllers\MailController; 



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



Route::get('/', function () {
    return 'okem'; 
}); 
Route::get('test', function () {
    return view('test'); 
}); 
Route::post('test',[t::class, 'index']); 

Route::prefix('home') -> name('home.') -> group( function ()  {
    Route::get('/', [HomeController::class, 'index']) ; 

    Route::get('/category/{id}', [HomeController::class, 'category']) -> name('category');

    Route::get('/brand/{id}', [HomeController::class, 'brand']) -> name('brand');

}); 
Route::get('/', function () {
    return view('test');
});

Route::prefix('admin') -> name('admin.') -> group( function () {
    Route::get('/', [Admin::class, 'index'])->name('login'); 
    
    Route::get('login_admin', [Admin::class, 'dashboard_show']) -> name('dashboard_show'); 

    Route::post('login_admin', [Admin::class, 'dashboard']) -> name('dashboard');

    Route::get('logout', [Admin::class, 'logout']) ->name('logout');

});
// Category 
Route::prefix('category') ->name('category.') -> group(function () {
        Route::get('/',[CategoryController::class, 'all_category']) -> name('all');
        Route::get('/add', [CategoryController::class, 'add_category']) -> name('add');

        Route::post('/add', [CategoryController::class, 'save_category']) -> name('addPost');

        Route::get('/active/{id}', [CategoryController::class, 'active_category']) -> name('active');
        Route::get('/unactive/{id}', [CategoryController::class, 'unactive_category']) ->name('unactive');

        // updae 
        Route::get('/update/{id}', [CategoryController::class, 'edit']) ->name('update');
        Route::post('/update/{id}', [CategoryController::class, 'edit_category']) -> name('updatePost');
        Route::get('/delete/{id}', [CategoryController::class, 'delete_category']) -> name('delete');
});

// brand 

Route::prefix('brand') ->name('brand.') -> group(function () {
    Route::get('/',[BrandController::class, 'all_brand']) -> name('all');
    Route::get('/add', [BrandController::class, 'add_brand']) -> name('add');

    Route::post('/add', [BrandController::class, 'save_brand']) -> name('addPost');

    Route::get('/active/{id}', [BrandController::class, 'active_brand']) -> name('active');
    Route::get('/unactive/{id}', [BrandController::class, 'unactive_brand']) ->name('unactive');

    // updae 
    Route::get('/update/{id}', [BrandController::class, 'edit']) ->name('update');
    Route::post('/update/{id}', [BrandController::class, 'edit_brand']) -> name('updatePost');
    Route::get('/delete/{id}', [BrandController::class, 'delete_brand']) -> name('delete');
});

Route::prefix('product') ->name('product.') -> group(function () {
    Route::get('/',[ProductController::class, 'all_product']) -> name('all');
    Route::get('/add', [ProductController::class, 'add_product']) -> name('add');

    Route::post('/add', [ProductController::class, 'save_product']) -> name('addPost');

    Route::get('/active/{id}', [ProductController::class, 'active_product']) -> name('active');
    Route::get('/unactive/{id}', [ProductController::class, 'unactive_product']) ->name('unactive');

    // update
    Route::get('/update/{id}', [ProductController::class, 'edit']) ->name('update');
    Route::post('/update/{id}', [ProductController::class, 'edit_product']) -> name('updatePost');
    Route::get('/delete/{id}', [ProductController::class, 'delete_product']) -> name('delete');
});
// manager_order
Route::prefix('manager_order') -> name('manager_order.') -> group(function () {
    Route::get('/', [OrderController::class, 'index']);

    // detail order
    Route::get('/order_detail/{id}', [OrderController::class, 'order_detail']) -> name('order_detail');

    // delete order
    Route::get('/delete_order/{id}', [OrderController::class, 'delete_order']) -> name('delete_order');
});

//Login facebook
Route::get('/login-facebook',[LoginController::class, 'login_facebook']) -> name('login_facebook');
Route::get('/admin/facebook/callback',[LoginController::class,'callback_facebook']) -> name('callback_facebook');
Route::get('/chinh-sach-rieng-tu', function () {
    return "Dang nhap quyen rieng tu"; 
});

// send mail
Route::get('send-mail', [MailController::class, 'send_mail']) -> name('send_mail');


// frontend 
// detail product
Route::get('product_detail/{id}', [HomeController::class, "detail"]) -> name('product_detai');

// cart 

Route::prefix('cart') -> name('cart.') -> group(function () {
    Route::post('/save-cart', [CartController::class, 'save_cart']) -> name('save');

    Route::get('/', [CartController::class, 'show_cart']) -> name('show');

    Route::get('/delete/{id}', [CartController::class, 'remove_cart']) -> name('remove');
    Route::post('/update', [CartController::class, 'update_cart']) -> name('update');

});

// check out 

Route::prefix('/checkout') -> name('checkout.') -> group( function () {
    Route::get('/checkout_login', [CheckoutController::class, 'login_checkout']) -> name('login_checkout');
    Route::get('/', [CheckoutController::class, 'checkout']);

    Route::post('/save_checkout', [CheckoutController::class, 'save_checkout']) -> name('save_checkout');

    // pay ment 
    Route::get('/payment', [CheckoutController::class, 'payment']) ->name('payment');
    Route::post('/order_place', [CheckoutController::class, 'order_place']) ->name('order_place');
});



Route::post('/login', [CustomerController::class, 'login']) -> name('login');
Route::get('/logout',[CustomerController::class, 'logout']) -> name('logout');
Route::post('/signup', [CustomerController::class, 'signup']) ->name('signup');


