<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ServicesController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\CollectorController;

/*
|--------------------------------------------------------------------------
| PUBLIC PAGES
|--------------------------------------------------------------------------
*/
Route::view('/', 'home')->name('home');
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');

Route::get('/services', [ServicesController::class, 'index'])->name('services');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/authlogin', [\App\Http\Controllers\Auth\LoginController::class, 'login']);

Route::get('/register', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])->name('register');
Route::post('/authregister', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'store']);

/*
|--------------------------------------------------------------------------
| CUSTOMER (AUTHENTICATED)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    /* CHECKOUT (from services page) */
    Route::post('/checkout', [OrderController::class, 'checkout'])
        ->name('checkout');

    /* PICKUP FORM */
    Route::get('/request-pickup', [OrderController::class, 'pickupForm'])
        ->name('orders.pickup.form');

    /* STORE PICKUP + CREATE ORDER */
    Route::post('/request-pickup', [OrderController::class, 'storePickup'])
        ->name('orders.pickup.store');

    /* CUSTOMER REQUESTS */
    Route::get('/my-requests', [OrderController::class, 'myRequests'])
        ->name('orders.my-requests');

    /* CART */
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

    /* PROFILE */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    /* LOGOUT */
    Route::post('/logout', function () {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('login');
    })->name('logout');
});

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

        Route::get('/customers', [AdminController::class, 'customers'])->name('customers');
        Route::get('/settings', [AdminController::class, 'settings'])->name('settings');

        /* ORDERS */
        Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders');
        Route::post('/orders/{order}/assign', [AdminOrderController::class, 'assignCollector'])
            ->name('orders.assign');

        /* SERVICES */
        Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
        Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
        Route::put('/services/{id}', [ServiceController::class, 'update'])->name('services.update');
        Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');
    });

/*
|--------------------------------------------------------------------------
| COLLECTOR PANEL
|--------------------------------------------------------------------------
*/
Route::prefix('collector')
    ->middleware(['auth', 'collector'])
    ->name('collector.')
    ->group(function () {

        Route::get('/dashboard', [CollectorController::class, 'index'])->name('dashboard');

        Route::get('/my-requests', [CollectorController::class, 'myRequests'])
            ->name('myRequests');

        Route::post('/order/{order}/pickup', [CollectorController::class, 'markPickedUp'])
            ->name('order.pickup');

        Route::post('/order/{order}/deliver', [CollectorController::class, 'markDelivered'])
            ->name('order.deliver');
    });
