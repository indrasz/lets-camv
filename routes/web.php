<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CamvController;
use App\Http\Controllers\Admin\UserController;

use App\Http\Controllers\Landing\UserController as LandingUserController;
use App\Http\Controllers\Landing\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DestinationController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Landing\CamvController as LandingCamvController;
use App\Http\Controllers\Landing\CheckoutController;
use App\Http\Controllers\Landing\DetailController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('detail/{id}', [DetailController::class, 'index'])->name('detail-destination');


Route::get('sign-in-google', [LandingUserController::class, 'google'])->name('user.login.google');
Route::get('auth/google/callback', [LandingUserController::class, 'handleProviderCallback'])->name('user.google.callback');

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::post('detail/{id}', [DetailController::class, 'add'])->name('detail-add');
    Route::get('camv/{id}', [LandingCamvController::class, 'index'])->name('choose-camv');
    Route::post('camv/{id}', [LandingCamvController::class, 'add'])->name('camv-add');
    Route::get('checkout/{id}', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('checkout/create/{id}', [CheckoutController::class, 'create'])->name('checkout-create');
    Route::get('success', [CheckoutController::class, 'success'])->name('checkout-success');

    Route::name('dashboard.')->prefix('dashboard')->group(function () {
        Route::middleware(['auth', 'admin'])->group(function () {
            Route::get('/', [DashboardController::class, 'index'])->name('index');
            Route::resource('categories', CategoryController::class)->only([
                'index', 'create', 'store', 'destroy'
            ]);
            Route::resource('destination', DestinationController::class);
            Route::resource('camv', CamvController::class);
            Route::resource('user', UserController::class);
            Route::resource('transaction', TransactionController::class)->only([
                'index', 'edit'
            ]);
        });
    });
});

require __DIR__ . '/auth.php';
