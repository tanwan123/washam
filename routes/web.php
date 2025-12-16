<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\ServicesController; 
use App\Http\Controllers\CollectorController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\ServiceOrderController; 


use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Public Pages
|--------------------------------------------------------------------------
*/
Route::view('/', 'home')->name('home');
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');
Route::view('/services', 'services')->name('services');
Route::get('/services', [ServicesController::class, 'index'])->name('services');
// web.php
Route::get('/request-pickup', [OrderController::class, 'create'])
    ->name('orders.create')
    ->middleware('auth');
        // Submit pickup request (AJAX / form)
    Route::post('/request-pickup', [OrderController::class, 'store'])
        ->name('orders.store');
   Route::get('/my-requests', [OrderController::class, 'myRequests'])
        ->name('orders.my');


/*
|--------------------------------------------------------------------------
| ORDER PAGES
|--------------------------------------------------------------------------
*/
Route::get('/order/book', [OrderController::class, 'create'])->name('order.create');
Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
Route::get('/orders/history', [OrderController::class, 'history'])->name('order.history');
// Confirm order page
Route::get('/order/confirm/{id}', [OrderController::class, 'confirm'])->name('order.confirm');

// Store order
Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');


/*
|--------------------------------------------------------------------------
| CART (Authenticated)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/cart', [CartController::class,'viewCart'])->name('cart.index');
    Route::post('/cart/add', [CartController::class,'add'])->name('cart.add');
    Route::post('/cart/clear', [CartController::class,'clear'])->name('cart.clear');
    Route::get('/cart/remove/{id}', [CartController::class,'remove'])->name('cart.remove');

    Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');

    /*
    |--------------------------------------------------------------------------
    | Orders
    |--------------------------------------------------------------------------
    */
    Route::get('/orders', [OrderController::class,'index'])->name('orders.index');
    Route::get('/orders/create', [OrderController::class,'create'])->name('orders.create');
    Route::post('/orders/store', [OrderController::class,'store'])->name('orders.store');
    Route::get('/order/success', [CartController::class, 'success'])->name('orders.success');
   Route::post('/checkout/store', [OrderController::class, 'store'])->name('checkout.store');


    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class,'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class,'update'])->name('profile.update');

    Route::post('/logout', function () {
    Auth::logout();

    session()->invalidate();
    session()->regenerateToken();

    return redirect()->route('login'); // 🔥 Redirect to login page
})->name('logout');
});

/*
|--------------------------------------------------------------------------
| AUTH: Login / Register
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/authlogin', [LoginController::class, 'login']);
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/authregister', [RegisteredUserController::class, 'store']);

/*
|--------------------------------------------------------------------------
| ADMIN PANEL
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::get('/customers', [AdminController::class, 'customers'])->name('customers');
        Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
        Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
Route::get('/admin/orders', [AdminOrderController::class, 'index'])
    ->middleware(['auth','admin'])
    ->name('admin.orders');

        /*
        |--------------------------------------------------------------------------
        | ADMIN SERVICES (NO RESOURCE ROUTE)
        |--------------------------------------------------------------------------
        */
        Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
        Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
        Route::put('/services/{id}', [ServiceController::class, 'update'])->name('services.update');
        Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');
});
// Collector routes
Route::prefix('collector')->middleware(['auth','collector'])->name('collector.')->group(function(){
    Route::get('/dashboard', [CollectorController::class,'index'])->name('dashboard');
      Route::get('/orders', [CollectorController::class, 'orders'])->name('orders'); 
       Route::get('/completed', [CollectorController::class, 'completedOrders'])->name('completed'); 
    Route::post('/order/{order}/pickup', [CollectorController::class,'markPickedUp'])->name('order.pickup');
    Route::post('/order/{order}/deliver', [CollectorController::class,'markDelivered'])->name('order.deliver');
    Route::get('/collector/pickups', [CollectorController::class, 'pickups'])
    ->middleware(['auth','collector'])
    ->name('collector.pickups');

    
});

// Admin assign collector
Route::prefix('admin')->middleware(['auth','admin'])->name('admin.')->group(function(){
    Route::get('/orders', [AdminController::class,'orders'])->name('orders');
    Route::get('/orders/{order}/assign', [AdminController::class,'assignCollectorForm'])->name('orders.assign.form');
    Route::post('/orders/{order}/assign', [AdminController::class,'assignCollector'])->name('orders.assign');
});