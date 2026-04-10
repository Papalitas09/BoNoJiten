<?php

use App\Http\Controllers\admin\ProductsController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AccountsController;
use App\Http\Controllers\admin\OrdersController;
use App\Http\Controllers\admin\DashboardController;

use App\Http\Controllers\user\ExploreController;
use App\Http\Controllers\user\ProfileController;
use App\Http\Controllers\user\HomeController;
use App\Http\Controllers\user\OrderController;
use App\Http\Controllers\user\FavoriteController;
use App\Http\Controllers\user\ProductController;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [AuthController::class, 'LoginView'])->name('login');
Route::post('login', [AuthController::class, 'Login'])->name('login.post');
Route::post('logout', [AuthController::class, 'Logout'])->name('logout');
Route::get('register', [AuthController::class, 'RegisterView'])->name('register');
Route::post('register', [AuthController::class, 'Register'])->name('register.post');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', ProductsController::class);
    Route::resource('accounts', AccountsController::class);
    Route::resource('orders', OrdersController::class);
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/Home', [HomeController::class, 'index'])->name('home');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/order', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/order/create/{product}', [OrderController::class, 'CreateOrder'])->name('orders.create');
    Route::post('/order', [OrderController::class, 'StoreOrder'])->name('orders.store');
    Route::get('/orders/detail/{id}', [OrderController::class, 'detailOrder'])->name('orders.detail');
    Route::get('/explore', [ExploreController::class, 'index'])->name('explore.index');
    Route::get('/favorites',           [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favorites/{product}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

    //cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{item}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{item}', [CartController::class, 'remove'])->name('cart.remove');
});
