<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReviewController;

/*
| Frontend
*/


Route::get('/', [FrontendController::class, 'home'])
    ->name('home');

Route::get('/store/products', [FrontendController::class, 'products'])
    ->name('products.front');

Route::get('/store/products/{id}', [FrontendController::class, 'productDetail'])
    ->name('product.detail');

Route::get('/cart', [FrontendController::class, 'cart'])
    ->name('cart');
Route::post('/cart/add/{id}', [FrontendController::class,'addToCart'])
    ->name('cart.add');
Route::get('/cart/remove/{id}', [FrontendController::class,'removeCart'])
    ->name('cart.remove');
Route::get('/cart/increase/{id}', [FrontendController::class, 'increaseCart'])
    ->name('cart.increase');
Route::get('/cart/decrease/{id}', [FrontendController::class, 'decreaseCart'])
    ->name('cart.decrease');

Route::get('/checkout', [FrontendController::class, 'checkout'])
    ->name('checkout');
Route::post('/checkout', [FrontendController::class,'checkoutStore'])
    ->name('checkout.store');

Route::get('/login', [FrontendController::class, 'login'])
    ->name('login');
    Route::post('/login', [FrontendController::class, 'loginCheck'])
    ->name('login.check');


Route::get('/logout',[FrontendController::class,'logout'])
    ->name('logout');

Route::get('/register', [FrontendController::class, 'register'])
    ->name('register');
Route::post('/register',[FrontendController::class,'registerStore'])
    ->name('register.store');

Route::get('/customer/orders', [FrontendController::class, 'orders'])
    ->name('frontend.orders');

Route::get('/orders', [FrontendController::class, 'orders'])
    ->name('frontend.orders');
Route::get('/my-orders', [FrontendController::class, 'myOrders'])
    ->name('my.orders');
Route::get('/my-orders/{id}', [FrontendController::class, 'myOrderDetail'])
    ->name('my.order.detail');
Route::get('/admin/login', [FrontendController::class, 'adminLogin'])
    ->name('admin.login');

Route::post('/admin/login', [FrontendController::class, 'adminLoginCheck'])
    ->name('admin.login.check');

Route::get('/admin/logout', [FrontendController::class, 'adminLogout'])
    ->name('admin.logout');
/*
 Admin
*/

Route::get('/admin', [DashboardController::class, 'index'])
    ->name('admin.dashboard');

Route::resource('categories', CategoryController::class);
Route::resource('brands', BrandController::class);
Route::resource('products', ProductController::class);
Route::resource('productimages', ProductImageController::class);
Route::resource('vouchers', VoucherController::class);
Route::resource('staffs', StaffController::class);
Route::resource('customers', CustomerController::class);
Route::resource('accounts', AccountController::class);
Route::resource('orders', OrderController::class);
Route::resource('orderdetails', OrderDetailController::class);

Route::get('/payments', [PaymentController::class, 'index'])
    ->name('payments.index');

Route::resource('reviews', ReviewController::class)
    ->only(['index', 'show', 'destroy']);