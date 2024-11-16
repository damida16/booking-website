<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('/categories', 'CategoryController@index')->name('categories');
// Route::get('/categories/{id}', 'CategoryController@detail')->name('categories-detail');

// Route::get('/details/{id}', 'DetailController@index')->name('detail');
// Route::post('/details/{id}', 'DetailController@add')->name('detail-add');

// Route::get('/success', 'CartController@success')->name('success');
// Route::post('/checkout/callback', 'CheckoutController@callback')->name('midtrans-callback');
// Route::get('/register/success', 'Auth\RegisterController@success')->name('register-success');

Route::middleware(['auth'])->group(function () {
    // Route::get('/cart', 'CartController@index')->name('cart');
    // Route::delete('/cart/{id}', 'CartController@delete')->name('cart-delete');
    // Route::post('/checkout', 'CheckoutController@process')->name('checkout');

    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::resource('products', DashboardProductController::class)->names('products');
        Route::middleware(['role:admin'])->group(function () {
            Route::resource('users', UserController::class)->names('users');
        });
        // Route::get('products/{id}', 'DashboardProductController@details')->name('dashboard-product-details');
        // Route::post('products/{id}', 'DashboardProductController@update')->name('dashboard-product-update');
        Route::post('products/gallery/upload', 'DashboardProductController@uploadGallery')->name('dashboard-product-gallery-upload');
        Route::get('products/gallery/delete/{id}', 'DashboardProductController@deleteGallery')->name('dashboard-product-gallery-delete');

        Route::get('transactions', 'DashboardTransactionController@index')->name('dashboard-transaction');
        Route::get('transactions/{id}', 'DashboardTransactionController@details')->name('dashboard-transaction-details');
        Route::post('transactions/{id}', 'DashboardTransactionController@update')->name('dashboard-transaction-update');

        Route::get('settings', 'DashboardSettingController@store')->name('dashboard-settings-store');
        Route::get('account', 'DashboardSettingController@account')->name('dashboard-settings-account');
        Route::post('update/{redirect}', 'DashboardSettingController@update')->name('dashboard-settings-redirect');
    });
});

Route::prefix('admin')->namespace('Admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', 'DashboardController@index')->name('admin-dashboard');
    Route::resources([
        'category' => 'CategoryController',
        'user' => 'User Controller',
        'product' => 'ProductController',
        'product-gallery' => 'ProductGalleryController',
        'transaction' => 'TransactionController',
    ]);
});

require __DIR__ . '/auth.php';
